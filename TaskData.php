<?php
// Include the database connection file
include "partials/sql-connction.php";

// Check if the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize inputs
    $task_name = mysqli_real_escape_string($conn, $_POST['task_name']);
    $project_id = mysqli_real_escape_string($conn, $_POST['project_id']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $priority = mysqli_real_escape_string($conn, $_POST['priority']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);
    $assigned_to = mysqli_real_escape_string($conn, $_POST['assigned_to']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);

    // Handling file upload for attachment
    $attachment = '';
    var_dump($_FILES);
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
        $upload_dir = 'Uploads/';
        $attachment = $upload_dir . basename($_FILES['attachment']['name']);
        if (!move_uploaded_file($_FILES['attachment']['tmp_name'], $attachment)) {
            echo "<script>alert('Failed to upload attachment'); window.history.back();</script>";
            exit();
        }
    }


    if (!empty($task_data['attachment'])) {
        echo '<a href="' . htmlspecialchars($task_data['attachment']) . '" target="_blank">View Attachment</a>';
    } else {
        echo 'No attachments uploaded.';
    }


    // SQL query to insert a new task into the tasks table
    $sql = "INSERT INTO project_tasks (project_id, task_name, `description`, category, `status`, priority, `start_date`, due_date, assigned_to, notes, attachment) 
    VALUES ('$project_id', '$task_name', '$description', '$category', '$status', '$priority', '$start_date', '$due_date', '$assigned_to', '$notes', '$attachment')";

    // Execute the query and check for success
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Task added successfully!'); window.location.href=' " . $_SERVER['HTTP_REFERER'] . "';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
