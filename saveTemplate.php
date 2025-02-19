<?php

include "partials/sql-connction.php";

// Read JSON data from request body
$data = json_decode(file_get_contents("php://input"), true);


if ($data) {
    $conn->begin_transaction(); // Start transaction to ensure data consistency

    try {
        // Extract project details
        $projectName = $data["projectName"];
        $projectAssignee = $data["projectAssignee"];
        $projectDue = $data["projectDue"];
        $projectRecurrence = $data["projectRecurrence"];
        $projectTags = $data["projectTags"]; // Array of tag names
        $projectDetails = $data["projectDetails"];
        $tasks = $data["tasks"]; // Array of tasks

        // Insert project into `project_template` table
        $stmt = $conn->prepare("INSERT INTO project_template (name, assignee, due, recurrence, details) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $projectName, $projectAssignee, $projectDue, $projectRecurrence, $projectDetails);
        $stmt->execute();
        $projectId = $conn->insert_id; // Get the inserted project ID
        $stmt->close();

        // Insert project tags into `tags` and `project_tags` tables
        foreach ($projectTags as $tagName) {
            // Check if tag already exists
            $stmt = $conn->prepare("SELECT id FROM tags WHERE tag_name = ?");
            $stmt->bind_param("s", $tagName);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $tagId = $row["id"];
            } else {
                // Insert new tag if not exists
                $stmt = $conn->prepare("INSERT INTO tags (tag_name) VALUES (?)");
                $stmt->bind_param("s", $tagName);
                $stmt->execute();
                $tagId = $conn->insert_id;
                $stmt->close();
            }

            // Insert into `project_tags` table
            $stmt = $conn->prepare("INSERT INTO project_tags (project_id, tag_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $projectId, $tagId);
            $stmt->execute();
            $stmt->close();
        }

        // Insert tasks into `tasks` table
        foreach ($tasks as $task) {
            $taskName = $task["taskName"];
            $taskAssignee = $task["taskAssignee"];
            $taskDue = $task["taskDue"];
            
            $stmt = $conn->prepare("INSERT INTO tasks (project_id, name, assignee, due) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("issi", $projectId, $taskName, $taskAssignee, $taskDue);
            $stmt->execute();
            $taskId = $conn->insert_id; // Get the inserted task ID
            $stmt->close();

            // Insert task tags into `tags` and `task_tags` tables
            foreach ($task["taskTags"] as $taskTag) {
                // Check if tag already exists
                $stmt = $conn->prepare("SELECT id FROM tags WHERE tag_name = ?");
                $stmt->bind_param("s", $taskTag);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($row = $result->fetch_assoc()) {
                    $tagId = $row["id"];
                } else {
                    // Insert new tag if not exists
                    $stmt = $conn->prepare("INSERT INTO tags (tag_name) VALUES (?)");
                    $stmt->bind_param("s", $taskTag);
                    $stmt->execute();
                    $tagId = $conn->insert_id;
                    $stmt->close();
                }

                // Insert into `task_tags` table
                $stmt = $conn->prepare("INSERT INTO task_tags (task_id, tag_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $taskId, $tagId);
                $stmt->execute();
                $stmt->close();
            }
        }

        $conn->commit(); // Commit transaction
        echo json_encode(["status" => "success", "message" => "Project and tasks saved successfully!"]);

    } catch (Exception $e) {
        $conn->rollback(); // Rollback transaction on failure
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No data received!"]);
}

$conn->close();
?>













// if ($data) {
//     // Extract project details
//     $projectName = $data["projectName"];
//     $projectAssignee = $data["projectAssignee"];
//     $projectDue = $data["projectDue"];
//     $projectRecurrence = $data["projectRecurrence"];
//     $projectTags = $data["projectTags"];
//     $projectDetails = $data["projectDetails"];
//     $tasks = $data["tasks"];

//     // Display project details
//     echo "Project Name: " . $projectName . "\n";
//     echo "Project Assignee: " . $projectAssignee . "\n";
//     echo "Project Due: " . $projectDue . "\n";
//     echo "Project Recurrence: " . $projectRecurrence . "\n";
//     echo "Project Details: " . $projectDetails . "\n";
//     echo "Project Tags: " . implode(", ", $projectTags) . "\n\n";

//     // Loop through tasks and display their details
//     echo "Tasks:\n";
//     foreach ($tasks as $task) {
//         echo "- Task Name: " . $task["taskName"] . "\n";
//         echo "- Task Assignee: " . $task["taskAssignee"] . "\n";
//         echo "- Task Due: " . $task["taskDue"] . "\n";
//         echo "- Task Details: " . $task["taskDetails"] . "\n";
//         echo "  Task Tags: " . implode(", ", $task["taskTags"]) . "\n\n";
//     }
// } else {
//     echo "No data received!";
// }




