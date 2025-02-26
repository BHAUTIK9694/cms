<?php

include "partials/sql-connction.php";  // Ensure this is your correct database connection
?>

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

<link rel="stylesheet" href="public/css/TaskOverview.css">
<link rel="stylesheet" href="public/css/table.css">
<link rel="stylesheet" href="public/css/textEditor.css">






<!-- <div class="search-bar">
    <form action="search_results.php" method="POST">
        <input type="text" name="search_bar" placeholder="Search Bar">
        <input type="text" name="company_name" placeholder="Company Name">
        <input type="date" name="created_date" placeholder="Created Date">
        <input type="date" name="created_date" placeholder="Created Date">
        <input type="text" name="sales_person" placeholder="Sales Person">
        <input type="text" name="lifecycle_stage" placeholder="Lifecycle Stage">
        <button type="submit" class="filter-btn">Filter</button>
    </form>
</div> -->
<div class="cms-task-sub-header">
    <div class="btn-container-proj-task">

        <div class="btn-container-task-88ikj">

            <button class="save-btn-0po90" onclick="openPopup()">
                <img src="./public/assets/addwhite.svg" alt="" style="color: white;">Add Task
            </button>
        </div>

    </div>
    <!-- <div class="cms-proj-add-btn-div">
        <button class="cms-proj-filter-btn" onclick="openPopup()">Add Task</button>
    </div> -->
</div>



<div class="filter-container">
    <button class="filter-btn" data-filter="all">All Items ▼</button>
    <button class="filter-btn" data-filter="grouped-by-status">Grouped by Category</button>
    <button class="filter-btn" data-filter="not-completed">Status Not Completed</button>
    <button class="filter-btn" data-filter="in-progress">Work In Progress</button>
    <button class="filter-btn" data-filter="progress-items">Progress Items</button>
</div>



<div class="table-container">
    <div class="table-inner-container">
        <table class="table" id="task-table">
            <thead>
                <tr>
                    <!-- <th>Task ID</th> -->
                    <th class="filter-header" data-filter="Task">
                        Task Name <span class="filter-icon">&#9662;</span>
                        <input type="text" class="filter-input hidden" placeholder="Search...">
                    </th>


                    <th>Category </th>

                    <th class="filter-header" data-filter="status">
                        Status <span class="filter-icon">&#9662;</span>
                        <select class="filter-dropdown hidden">
                            <option value="">All</option>
                        </select>
                    </th>
                    <th>Priority</th>
                    <th>Start Date</th>
                    <th>Due Date</th>
                    <th>Assign to</th>
                    <!-- <th>Notes</th> -->

                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Query to fetch all tasks from the database
                
                $stmt = $conn->prepare("SELECT * FROM project_tasks WHERE project_id = ? ");
                $stmt->bind_param("i", $proj_id);
                $stmt->execute();
                $result = $stmt->get_result();


                // Array to define the class for each task status
                $statuses = [
                    "Not Started" => "status-not-started",
                    "In Progress" => "status-in-progress",
                    "Completed" => "status-completed",
                    "On Hold" => "status-on-hold",


                ];

                // Check if there are any tasks
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each task and display it in the table
                    while ($task = mysqli_fetch_assoc($result)) {
                        // Determine the status class based on the task status
                        $statusClass = isset($statuses[$task['status']]) ? $statuses[$task['status']] : "status-default";
                        echo "<tr class='task-row' data-category='" . htmlspecialchars($task['category']) . "' data-status='" . htmlspecialchars($task['status']) . "' data-assigned='" . htmlspecialchars($task['assigned_to']) . "'>";
                        // echo "<td>" . htmlspecialchars($task['task_id']) . "</td>";
                        ?>
                        <td><a href="#" class="task-link" data-task-id="<?= htmlspecialchars($task['task_id']) ?>">
                                <?= !empty($task['task_name']) ? htmlspecialchars($task['task_name']) : '--' ?>
                            </a></td>
                        <?php

                        // echo "<td><a href='TaskOverview.php?task_id=" . htmlspecialchars($task['task_id']) . "'>" . (!empty($task['task_name']) ? htmlspecialchars($task['task_name']) : '--') . "</a></td>";
                        echo "<td>" . (!empty($task['category']) ? htmlspecialchars($task['category']) : '--') . "</td>";
                        echo "<td class='status'><span class='status-badge $statusClass'>" . (!empty($task['status']) ? htmlspecialchars($task['status']) : '--') . "</span></td>";
                        echo "<td>" . (!empty($task['priority']) ? htmlspecialchars($task['priority']) : '--') . "</td>";
                        echo "<td>" . (!empty($task['start_date']) ? date("d M Y", strtotime($task['start_date'])) : '--') . "</td>";
                        echo "<td>" . (!empty($task['due_date']) ? date("d M Y", strtotime($task['due_date'])) : '--') . "</td>";
                        echo "<td>" . (!empty($task['assigned_to']) ? htmlspecialchars($task['assigned_to']) : '--') . "</td>";
                        // echo "<td>" . (!empty($task['notes']) ? nl2br(htmlspecialchars($task['notes'])) : '--') . "</td>";
                        echo "<td>" . (!empty($task['description']) ? nl2br(htmlspecialchars($task['description'])) : '--') . "</td>";

                        // Edit and Delete Actions
                        echo "<td>
                    <a href='EditTask.php?task_id=" . htmlspecialchars($task['task_id']) . "'><img src='./public/assets/edit.svg' alt=''></a>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href='DeleteTask.php?task_id=" . htmlspecialchars($task['task_id']) . "' onclick=\"return confirm('Are you sure you want to delete this task?');\">
                        <img src='./public/assets/delete.svg' alt=''>
                    </a>
                </td>";

                        echo "</tr>";
                    }
                } else {
                    // If no tasks are found, display a message
                    echo "<tr><td colspan='12'>No tasks found</td></tr>";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

</div>

</div>

<!-- The Popup Form -->
<div class="popup-overlay" onclick="closePopup()"></div>
<div class="popup-form">
    <form action="TaskData.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="project_id" value="<?php echo $_GET["Id"] ?>">

        <div class="form-input">
            <input type="text" class="form-control" id="taskName" name="task_name" placeholder="Task Name" required>
            <label for="taskName" class="form-label">Task Name</label>
        </div>
        <h4 style="margin-bottom: 1rem;">Description</h4>
        <div class="form-input-des item6" style="margin-bottom: 20px;">
            <input type="hidden" name="task_Detail_Texteditor" id="texteditor-hidden-task-9087plj2">
            <div class="wsyig" id="wsyigTask-9087plj2"></div>
        </div>

        <div class="tags-input" id="taskTagsDiv">
            <input type="hidden" id="task_tags" name="task_tags">
            <ul>
                <input type="text" id="taskTags" name="task_tags" placeholder="Tags">
            </ul>
        </div>

        <div class="custom-select">
            <select name="category" id="category" class="form-control">
                <option value="Select Category">Select Category</option>
                <option value="Development">Development</option>
                <option value="Design">Design</option>
                <option value="Research">Research</option>
                <option value="Marketing">Marketing</option>
            </select>
            <label for="category" class="form-label">Category</label>
        </div>

        <div class="custom-select">
            <select name="status" id="status" class="form-control">
                <option value="Todo">Todo</option>
                <option value="In Progress">In Progress</option>
                <option value="On Hold">On hold</option>
                <option value="Waiting on Client">Waiting on Client</option>
                <option value="Canceled">Canceled</option>
                <option value="Completed'">Completed</option>
            </select>
            <label for="status" class="form-label">Status</label>
        </div>

        <div class="custom-select">
            <select name="priority" id="priority" class="form-control">
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
                <option value="Urgent">Urgent</option>
            </select>
            <label for="priority" class="form-label">Priority</label>
        </div>

        <div class="form-input">
            <input type="date" class="form-control" id="startDate" name="start_date">
            <label for="startDate" class="form-label">Start Date</label>
        </div>

        <div class="form-input">
            <input type="date" class="form-control" id="dueDate" name="due_date">
            <label for="dueDate" class="form-label">Due Date</label>
        </div>

        <div class="form-input">
            <input type="number" id="project_due_days" name="task_due_days" placeholder="Due days from creation"
                required />
            <label for="task_due_days">Due days from creation</label>
        </div>

        <div class="form-input">
            <input type="text" class="form-control" id="assignedTo" name="assigned_to" placeholder="Assigned To">
            <label for="assignedTo" class="form-label">Assignee</label>
        </div>

        <h4 style="margin-bottom: 1rem;">Notes</h4>
        <div class="form-input-des item6" style="margin-bottom: 20px;">
            <input type="hidden" name="taskNotes_Detail_Texteditor" id="texteditor-hidden-taskNotes-9087plj2">
            <div class="wsyig" id="wsyigTaskNotes-9087plj2"></div>
        </div>

        <div class="form-input">
            <input type="file" class="form-control" id="attachment" name="attachment">
            <label for="attachment" class="form-label">Attachment</label>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-success" onclick="closePopup()">Cancel</button>
    </form>
</div>


<div id="task-popup" class="popup-container">
    <div class="popup-content">
        <span class="close-popup">&times;</span>
        <div id="task-details-container">
            <!-- Task details will be displayed here -->
        </div>
    </div>
</div>


<script src="public/js/Task.js"></script>
<script src="public/js/TagInput.js"></script>
<script src="public/js/Common/TextEditor.js"></script>
<script>
    new TextEditor("wsyigTask-9087plj2", "texteditor-hidden-task-9087plj2");
    new TextEditor("wsyigTaskNotes-9087plj2", "texteditor-hidden-taskNotes-9087plj2");
    new TagsInput("taskTagsDiv", "task_tags");
</script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const table = document.getElementById('task-table');
        const taskNameHeader = document.querySelector('[data-filter="Task"]');
        const taskNameInput = taskNameHeader.querySelector('.filter-input');

        const statusHeader = document.querySelector('[data-filter="status"]');
        const statusDropdown = statusHeader.querySelector('.filter-dropdown');

        // Toggle input visibility for Task Name
        taskNameHeader.addEventListener('click', function () {
            taskNameInput.classList.toggle('hidden');
            taskNameInput.focus();
        });

        // Filter table rows based on Task Name
        taskNameInput.addEventListener('keyup', function () {
            const filterValue = taskNameInput.value.toLowerCase();
            filterTable();
        });

        // Toggle dropdown visibility for Status
        statusHeader.addEventListener('click', function () {
            statusDropdown.classList.remove('hidden');
        });

        // Populate Status Dropdown with unique values from the table
        function populateStatusDropdown() {
            const statuses = new Set();
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const statusCell = row.cells[3].textContent.trim();
                statuses.add(statusCell);
            });

            statuses.forEach(status => {
                const option = document.createElement('option');
                console.log(statuses);
                option.value = status;
                option.textContent = status;
                statusDropdown.appendChild(option);
            });
        }

        // Filter table rows based on Status
        statusDropdown.addEventListener('change', function () {
            filterTable();
        });

        function filterTable() {
            const taskNameValue = taskNameInput.value.toLowerCase();
            const statusValue = statusDropdown.value.toLowerCase();

            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const taskNameCell = row.cells[0].textContent.toLowerCase();
                const statusCell = row.cells[3].textContent.toLowerCase();

                const taskNameMatch = taskNameCell.includes(taskNameValue);
                const statusMatch = statusValue === '' || statusCell === statusValue;

                if (taskNameMatch && statusMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        populateStatusDropdown();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
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