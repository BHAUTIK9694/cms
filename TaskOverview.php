<?php
// Include database connection file
include "partials/sql-connction.php";

// Get the task ID from the URL (ensure it's an integer)
$task_id = isset($_GET['task_id']) ? (int) $_GET['task_id'] : 0;

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

<head>
    <style>
        .task-overview-container-9023ok {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .header {
            background-color: #e0e0e0;
            padding: 10px;
            display: flex;
            justify-content-9023ok: flex-start;
            gap: 10px;
        }

        .header button {
            padding: 8px 12px;
            border: none;
            cursor: pointer;
        }

        .content-9023ok {
            display: flex;
            flex-grow: 1;
        }

        .left-section-9023ok {
            min-width: 400px;
            flex: 2;
            padding: 20px;
            background-color: white;
            border-right: 1px solid #ddd;
        }

        .right-section {
            flex: 1;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: calc(100% - 12px);
            padding: 5px;
            border: none;
            outline: none;

        }

        .form-group textarea {
            resize: vertical;
        }

        .edit-description {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2em;
            position: relative;
            top: -30px;
            left: calc(100% - 30px);
        }

        .comments-header {
            display: flex;
            justify-content-9023ok: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .comments-input input {
            width: calc(100% - 12px);
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .comments-list {
            overflow-y: auto;
            max-height: 300px;
        }

        .comment-item {
            display: flex;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .comment-content-9023ok {
            flex-grow: 1;
        }

        .user-name {
            font-weight: bold;
            display: block;
        }

        .comment-text {
            margin: 5px 0;
        }

        .comment-date {
            font-size: 0.8em;
            color: #888;
        }


        .close-right {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2em;
        }
    </style>
</head>

<body>

    <div class="task-overview-container-9023ok">

        <div class="content-9023ok">
            <form action="UpdateTask.php" method="POST">
            <input type="hidden" name="task_id" value="<?php echo $task_id;?>">
            <?php 
            // $project_id_current = $_GET["Id"];
            ?>
            <!-- <input type="hidden" name="url" value="<?php echo 'ProjectOverview.php?id='.$project_id_current;?>"> -->

                <div class="left-section-9023ok">
                    <div class="form-group">
                        <label for="work-item">Task Name</label>
                        <input type="text" id="work-item" name="taskName" value="<?= htmlspecialchars($task_data['task_name']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" id="category" name="category" value="<?= htmlspecialchars($task_data['category']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="progress">Status</label>
                        <select id="progress" name="status">
                            <option value="not-started" selected><?= htmlspecialchars($task_data['status']) ?></option>
                            <option value="in-progress">In progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="progress">Priority</label>
                        <select id="progress" name="priority">
                            <option value="not-started" selected><?= htmlspecialchars($task_data['priority']) ?></option>
                            <option value="in-progress">In progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start-date">Start date</label>
                        <input type="date" id="start-date" name="startDate" placeholder="Enter value here" value="<?= htmlspecialchars($task_data['start_date']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="due-date">Due date</label>
                        <input type="date" id="due-date" name="dueDate" placeholder="Enter value here" value="<?= htmlspecialchars($task_data['due_date']) ?>" >
                    </div>
                    <div class="form-group">
                        <label for="assigned-to">Assigned to</label>
                        <input type="text" id="assigned-to" name="assignedTo" placeholder="Enter a name or email address" value="<?= htmlspecialchars($task_data['assigned_to']) ?>" >
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" ><?= htmlspecialchars($task_data['description']) ?></textarea>
                    </div>
    
                   
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea id="notes" name="notes"><?= htmlspecialchars($task_data['notes']) ?></textarea>
                    </div>
                    <div>
                        <button type="submit">Save</button>
                    </div>
                </div>

            </form>
            <div class="right-section">
                <div class="comments-header">
                    <span>Comments ▼</span>
                    <button class="close-right">X</button>
                </div>
                <div class="comments-input">
                    <input type="text" placeholder="@mention or comment">
                </div>
                <div class="comments-list">
                    <div class="comment-item">
                        <img src="user1.jpg" alt="User 1" class="user-avatar">
                        <div class="comment-content">
                            <span class="user-name">Bhautik Kotadiya</span>
                            <p class="comment-text">Trial</p>
                            <span class="comment-date">Dec 18, 2024</span>
                        </div>
                    </div>
                    <div class="comment-item">
                        <img src="user2.jpg" alt="User 2" class="user-avatar">
                        <div class="comment-content">
                            <span class="user-name">You</span>
                            <p class="comment-text">This one</p>
                            <span class="comment-date">Dec 19, 2024</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Task Details Panel (Popup) -->

    <!-- <div class="details-box">
        <h5>Task Name</h5>
        <p id="taskDescription"><?= htmlspecialchars($task_data['task_name']) ?></p>
    </div> -->


    <!-- <div class="details-box">
        <h5>Description</h5>
        <p id="taskDescription"><?= htmlspecialchars($task_data['description']) ?></p>
    </div> -->

    <!-- <div class="details-box">
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
    </div> -->

    <!-- <div class="attachments-box">
        <h5>Attachments</h5>
        <p><?= $task_data['attachment'] ? "<a href='{$task_data['attachment']}' target='_blank'>View Attachment</a>" : "No attachments uploaded." ?></p>
    </div> -->

    <!-- <div class="activity-box">
        <h5>Activity</h5>
        <div class="comment-box mb-3">
            <textarea class="form-control" placeholder="Write a comment..." rows="3"></textarea>
            <button class="btn btn-primary mt-2">Submit Comment</button>
        </div>


        <div class="history-box">
            <p><strong>History:</strong></p>
            <p>Created by <?= htmlspecialchars($task_data['assigned_to']) ?> 1 hour ago.</p>
        </div>
    </div> -->


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