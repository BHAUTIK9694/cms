<?php
include "partials/sql-connction.php";

$templateId = isset($_POST['template_id']) ? intval($_POST['template_id']) : 0;

if ($templateId > 0) {
    try {
        // Fetch template details
        $templateQuery = "SELECT * FROM project_template WHERE id = ?";
        $templateStmt = $conn->prepare($templateQuery);
        $templateStmt->bind_param("i", $templateId);
        $templateStmt->execute();
        $templateResult = $templateStmt->get_result();
        $templateData = $templateResult->fetch_assoc();
        $templateStmt->close();

        if ($templateData) {
            // Insert project data based on the template
            $projectInsertQuery = "INSERT INTO project (project_name, project_due_days, project_recurrence, project_description) VALUES (?, ?, ?, ?)";
            $projectStmt = $conn->prepare($projectInsertQuery);
            $NOCLIENT = "No Client";
            $PENDING = "Pending";
            $projectStmt->bind_param("siss", $templateData['name'], $templateData['due'], $templateData['recurrence'], $templateData['details']); // Adjust default values
            $projectStmt->execute();
            $projectId = $projectStmt->insert_id; // Get the ID of the newly created project
            $projectStmt->close();

            // Insert tasks based on template
            $taskInsertQuery = "SELECT * FROM tasks WHERE project_id = ?";
            $taskStmt = $conn->prepare($taskInsertQuery);
            $taskStmt->bind_param("i", $templateId);
            $taskStmt->execute();
            $taskResult = $taskStmt->get_result();
            $taskStmt->close();

            if ($taskResult && $taskResult->num_rows > 0) {
                while ($taskRow = $taskResult->fetch_assoc()) {
                    $projectTasksInsertQuery = "INSERT INTO project_tasks (task_id, project_id, task_name, description, category, status, priority, due_date, assigned_to) VALUES (NULL, ?, ?, ?, 'Default Category', 'To Do', 'Medium', ?, ?)";
                    $projectTasksStmt = $conn->prepare($projectTasksInsertQuery);

                    $taskDueDate = date('Y-m-d', strtotime('+' . $taskRow['due'] . ' days'));
                    $projectTasksStmt->bind_param("issss", $projectId, $taskRow['name'], $templateData['details'], $taskDueDate, $taskRow['assignee']); // Assuming taskRow due is an int.
                    $projectTasksStmt->execute();
                    $projectTasksStmt->close();
                }
            }

            echo json_encode(['status' => 'success', 'message' => 'Project created successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Template not found.']);
        }

    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
    }

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid template ID.']);
}

$conn->close();
?>