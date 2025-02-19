<?php
// Include database connection
include 'partials/sql-connction.php';


// Check if task_id is set and is a valid number
if (isset($_GET['task_id']) && is_numeric($_GET['task_id'])) {
    error_log("Task ID received: " . $_GET['task_id']);  // Log the task_id

    // Prepare statement to fetch task details
    $stmt = $conn->prepare("SELECT * FROM project_tasks WHERE task_id = ?");
    $stmt->bind_param("i", $_GET['task_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if task exists
    if ($result->num_rows > 0) {
        $task = $result->fetch_assoc();
    } else {
        echo "Task not found!";
        exit();
    }
    $stmt->close();
} else {
    echo "Invalid Request! Task ID is missing or invalid.";
    exit();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="shortcut icon" href="./public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="public/css/input.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        .popup-form {

            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            z-index: 1000;
            width: 600px;
            max-height: 80%;
            overflow-y: auto;
            width: 40%;
        }

        .popup-form button {
            background-color: #007474;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .popup-form button:hover {
            background-color: #005f5f;
        }

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }


        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>

<body>

    <div class="popup-form">
        <form action="UpdateTask.php" method="POST" enctype="multipart/form-data">
            <h3>Edit Task Information</h3>

            <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">
            <input type="hidden" name="url" value="<?= $_SERVER['HTTP_REFERER'] ?>">

            <div class="form-input">
                <input type="text" class="form-control" id="taskName" name="taskName" value="<?= htmlspecialchars($task['task_name']) ?>" required>
                <label for="taskName" class="form-label">Task Name</label>
            </div>

            <div class="form-input">
                <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($task['description']) ?></textarea>
                <label for="description" class="form-label">Description</label>
            </div>

            <div class="custom-select">
                <select name="category" id="category" class="form-control" required>
                    <option value="Development" <?= ($task['category'] == 'Development') ? 'selected' : '' ?>>Development</option>
                    <option value="Design" <?= ($task['category'] == 'Design') ? 'selected' : '' ?>>Design</option>
                    <option value="Research" <?= ($task['category'] == 'Research') ? 'selected' : '' ?>>Research</option>
                    <option value="Marketing" <?= ($task['category'] == 'Marketing') ? 'selected' : '' ?>>Marketing</option>
                </select>
                <label for="category" class="form-label">Category</label>
            </div>

            <div class="custom-select">
                <select name="status" id="status" class="form-control" required>
                    <option value="Not Started" <?= ($task['status'] == 'Not Started') ? 'selected' : '' ?>>Not Started</option>
                    <option value="In Progress" <?= ($task['status'] == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
                    <option value="Completed" <?= ($task['status'] == 'Completed') ? 'selected' : '' ?>>Completed</option>
                    <option value="On Hold" <?= ($task['status'] == 'On Hold') ? 'selected' : '' ?>>On Hold</option>
                </select>
                <label for="status" class="form-label">Status</label>
            </div>

            <div class="custom-select">
                <select name="priority" id="priority" class="form-control" required>
                    <option value="Low" <?= ($task['priority'] == 'Low') ? 'selected' : '' ?>>Low</option>
                    <option value="Medium" <?= ($task['priority'] == 'Medium') ? 'selected' : '' ?>>Medium</option>
                    <option value="High" <?= ($task['priority'] == 'High') ? 'selected' : '' ?>>High</option>
                    <option value="Urgent" <?= ($task['priority'] == 'Urgent') ? 'selected' : '' ?>>Urgent</option>
                </select>
                <label for="priority" class="form-label">Priority</label>
            </div>

            <div class="form-input">
                <input type="date" class="form-control" id="startDate" name="startDate" value="<?= $task['start_date'] ?>" required>
                <label for="startDate" class="form-label">Start Date</label>
            </div>

            <div class="form-input">
                <input type="date" class="form-control" id="dueDate" name="dueDate" value="<?= $task['due_date'] ?>" required>
                <label for="dueDate" class="form-label">Due Date</label>
            </div>

            <div class="form-input">
                <input type="text" class="form-control" id="assignedTo" name="assignedTo" value="<?= htmlspecialchars($task['assigned_to']) ?>" required>
                <label for="assignedTo" class="form-label">Assigned To</label>
            </div>

            <div class="form-input">
                <textarea class="form-control" id="notes" name="notes"><?= htmlspecialchars($task['notes']) ?></textarea>
                <label for="notes" class="form-label">Notes</label>
            </div>

            <div class="form-input">
                <input type="file" class="form-control" id="attachment" name="attachment">
                <label for="attachment" class="form-label">Attachment</label>
                <p>Current File: <?= !empty($task['attachment']) ? htmlspecialchars($task['attachment']) : 'No file attached' ?></p>
            </div>

            <button type="submit" class="btn btn-success">Update Task</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back()">Cancel</button>
        </form>
    </div>
    <script src="public/js/Task.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const attachmentCells = document.querySelectorAll(".attachment-cell");

            attachmentCells.forEach(cell => {
                const filename = cell.getAttribute("data-filename");

                if (filename && filename !== '') {
                    const fileLink = document.createElement("a");
                    fileLink.href = "Uploads/" + filename;
                    fileLink.textContent = "View File";
                    fileLink.target = "_blank";
                    fileLink.style.color = "blue";
                    fileLink.style.textDecoration = "underline";
                    cell.appendChild(fileLink);
                } else {
                    cell.textContent = "No Attachment";
                }
            });
        });
    </script>

</body>

</html>