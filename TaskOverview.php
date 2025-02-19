<?php
// Include database connection file
include "partials/sql-connction.php";

// Get the task ID from the URL (ensure it's an integer)
$task_id = isset($_GET['task_id']) ? (int)$_GET['task_id'] : 0;

// Check if a valid task ID is provided
if ($task_id > 0) {
    // Prepare a SQL query to fetch task details from the database
    $stmt_task = $conn->prepare("SELECT * FROM project_tasks WHERE task_id = ?");
    $stmt_task->bind_param("i", $task_id);
    $stmt_task->execute();
    $result_task = $stmt_task->get_result();

    if ($result_task->num_rows > 0) {
        $task_data = $result_task->fetch_assoc();  // Fetch the task data
    } else {
        echo "Task not found!";
        exit();
    }
} else {
    echo "Task ID not found!";
    exit();
}
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<body>




    <!-- Task Details Panel (Popup) -->

    <div class="details-box">
        <h5>Task Name</h5>
        <p id="taskDescription"><?= htmlspecialchars($task_data['task_name']) ?></p>
    </div>


    <div class="details-box">
        <h5>Description</h5>
        <p id="taskDescription"><?= htmlspecialchars($task_data['description']) ?></p>
    </div>

    <div class="details-box">
        <h5>Task Details</h5>
        <ul>
            <li><strong>Assignee:</strong> <?= htmlspecialchars($task_data['assigned_to']) ?></li>
            <li><strong>Labels:</strong> <?= htmlspecialchars($task_data['category']) ?></li>
            <li><strong>Start Date:</strong> <?= htmlspecialchars($task_data['start_date']) ?></li>
            <li><strong>Due Date:</strong> <?= htmlspecialchars($task_data['due_date']) ?></li>
            <li><strong>Task ID:</strong> <?= htmlspecialchars($task_data['task_id']) ?></li>
            <li><strong>Priority:</strong> <?= htmlspecialchars($task_data['priority']) ?> Priority</span></li>
            <li><strong>Status:</strong> <?= htmlspecialchars($task_data['status']) ?></span></li>
            <li><strong>Notes:</strong> <?= htmlspecialchars($task_data['notes']) ?></li>
        </ul>
    </div>

    <div class="attachments-box">
        <h5>Attachments</h5>
        <p><?= $task_data['attachment'] ? "<a href='{$task_data['attachment']}' target='_blank'>View Attachment</a>" : "No attachments uploaded." ?></p>
    </div>

    <div class="activity-box">
        <h5>Activity</h5>
        <div class="comment-box mb-3">
            <textarea class="form-control" placeholder="Write a comment..." rows="3"></textarea>
            <button class="btn btn-primary mt-2">Submit Comment</button>
        </div>


        <div class="history-box">
            <p><strong>History:</strong></p>
            <p>Created by <?= htmlspecialchars($task_data['assigned_to']) ?> 1 hour ago.</p>
        </div>
    </div>
    </div>

    <script>
        function openTaskDetails(taskName) {
            const panel = document.getElementById('taskDetailsPanel');
            const content = document.getElementById('taskDetailsContent');



            // Open the task details panel by adding the 'open' class
            panel.classList.add('open');
        }

        function closeTaskDetails() {
            const panel = document.getElementById('taskDetailsPanel');
            // Close the task details panel by removing the 'open' class
            panel.classList.remove('open');
        }
    </script>


</body>


</html>