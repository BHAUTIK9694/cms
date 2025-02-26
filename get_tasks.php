<?php
// this file is used in the client overview page for retriving the task details.

include "partials/sql-connction.php";

$projectId = isset($_GET['project_id']) ? intval($_GET['project_id']) : 0;

$statuses = [
    "Pending" => "status-pending",
    "In Progress" => "status-in-progress",
    "Completed" => "status-completed",
    "On Hold" => "status-on-hold",
    "Not Started" => "status-not-started",
];
if ($projectId > 0) {
    try {
        $stmt = $conn->prepare("SELECT task_name, assigned_to, start_date, due_date, status FROM project_tasks WHERE project_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error);
        }
        $stmt->bind_param("i", $projectId);
        $stmt->execute();
        $taskResult = $stmt->get_result();
        $stmt->close();

        if ($taskResult && $taskResult->num_rows > 0) {
            while ($taskRow = $taskResult->fetch_assoc()) {
                $statusClass = isset($statuses[$taskRow['status']]) ? $statuses[$taskRow['status']] : "status-default";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($taskRow['task_name']) . "</td>";
                echo "<td>" . htmlspecialchars($taskRow['assigned_to']) . "</td>";
                echo "<td>" . htmlspecialchars($taskRow['start_date']) . "</td>";
                echo "<td>" . htmlspecialchars($taskRow['due_date']) . "</td>";
                echo "<td class='status'><span class='status-badge $statusClass'>" . htmlspecialchars($taskRow['status']) . "</span></td>";
                // echo "<td>" . htmlspecialchars($taskRow['status']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No tasks found for this project.</td></tr>";
        }
    } catch (Exception $e) {
        echo "<tr><td colspan='5'>Error getting tasks: " . $e->getMessage() . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='5'>Invalid project ID.</td></tr>";
}

$conn->close();


?>