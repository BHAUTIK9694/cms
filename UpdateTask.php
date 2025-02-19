<?php
// Include database connection
include 'partials/sql-connction.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = $_POST['task_id'];
    $task_name = $_POST['taskName'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $priority = $_POST['priority'];
    $start_date = $_POST['startDate'];
    $due_date = $_POST['dueDate'];
    $assigned_to = $_POST['assignedTo'];
    $notes = $_POST['notes'];

    // File Upload Handling
    if (!empty($_FILES['attachment']['name'])) {
        $target_dir = "Uploads/";
        $target_file = $target_dir . basename($_FILES["attachment"]["name"]);

        // Move uploaded file
        if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
            $attachment = $target_file;
        } else {
            echo "Error uploading file.";
            exit();
        }
    } else {
        $attachment = $_POST['existing_attachment'] ?? '';
    }

    // Update query with prepared statement
    $stmt = $conn->prepare("UPDATE project_tasks SET task_name=?, description=?, category=?, status=?, priority=?, start_date=?, due_date=?, assigned_to=?, notes=?, attachment=? WHERE task_id=?");
    $stmt->bind_param("ssssssssssi", $task_name, $description, $category, $status, $priority, $start_date, $due_date, $assigned_to, $notes, $attachment, $task_id);

    if ($stmt->execute()) {
        header("Location: " . $_POST["url"]);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
