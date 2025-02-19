<?php
// Include the database connection
include 'partials/sql-connction.php';

if (isset($_GET['task_id'])) {  // Ensure correct GET parameter
    $task_id = $_GET['task_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM project_tasks WHERE task_id = ?");
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        // Redirect to Task.php after successful deletion
        header("Location: " . $_POST["url"]);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // Close statement
}

// Close connection
$conn->close();
