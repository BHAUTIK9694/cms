<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Management</title>
    <link rel="shortcut icon" href="./public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="public/css/input.css">
    <link rel="stylesheet" href="public/css/table.css">
    <link rel="stylesheet" href="public/css/project.css">
    <link rel="stylesheet" href="public/css/popup.css">
    <link rel="stylesheet" href="public/css/textEditor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <?php include 'partials/navbar.php'; ?>
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

    <div class="btn-container">
        <button class="save-btn-0po90" onclick="openProjectTemplatePopup(event)">
            Use Template
        </button>

        <button class="save-btn-0po90" onclick="openPopup(event)">
            <img src="./public/assets/addwhite.svg" alt="" style="color: white; width: 16px;">Add Project
        </button>

    </div>


    <div class="filter-container">
        <button class="filter-btn" data-filter="all">All Items ▼</button>
        <button class="filter-btn" data-filter="grouped-by-status">Grouped by Status</button>
        <button class="filter-btn" data-filter="not-completed">Status Not Completed</button>
        <button class="filter-btn" data-filter="in-progress">Work In Progress</button>
        <button class="filter-btn" data-filter="progress-items">Progress Items</button>
        <button class="filter-btn" onclick="applyFilter('Progress board')">Card View</button>
    </div>



    <hr>



    <div class="table-container">
        <div class="table-inner-container">

            <table class="table" id="project-table">
                <thead>
                    <tr>
                        <th>Project Id</th>
                        <th>Project Name</th>
                        <th class="filter-header" data-filter="client">
                            Client Name <span class="filter-icon">&#9662;</span>
                            <input type="text" class="filter-input hidden" placeholder="Search...">
                        </th>

                        <th>Tags</th>
                        <th class="filter-header" data-filter="status">
                            Status <span class="filter-icon">&#9662;</span>
                            <select class="filter-dropdown hidden">
                                <option value="">All</option>
                            </select>
                        </th>
                        <th>Team Members</th>
                        <th>Start date</th>
                        <th>Sales Person</th>
                        <th class="filter-header" data-filter="manager">
                            Manager <span class="filter-icon">&#9662;</span>
                            <input type="text" class="filter-input hidden" placeholder="Search...">
                        </th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include "partials/sql-connction.php";

                    // $query = "SELECT * FROM project";
                    // $result = mysqli_query($conn, $query);
                    
                    $query = "SELECT p.*, c.client_name FROM project p LEFT JOIN client_primaryinfo c ON p.client_id = c.client_id";
                    $result = mysqli_query($conn, $query);

                    $statuses = [
                        "Pending" => "status-pending",
                        "In Progress" => "status-in-progress",
                        "Completed" => "status-completed",
                        "On Hold" => "status-on-hold",
                    ];

                    if (mysqli_num_rows($result) > 0) {
                        while ($project = mysqli_fetch_assoc($result)) {
                            $statusClass = isset($statuses[$project['status']]) ? $statuses[$project['status']] : "status-default";

                            echo "<tr class='project-row' data-client='{$project['client_name']}' data-status='{$project['status']}' data-manager='{$project['manager']}'>";
                            echo "<td>" . $project['id'] . "</td>";
                            echo "<td><a href='ProjectOverview.php?Id=" . $project['id'] . "'>" . (!empty($project['project_name']) ? $project['project_name'] : '--') . "</a></td>";
                            echo "<td class='client'>" . (!empty($project['client_name']) ? $project['client_name'] : '--') . "</td>";
                            echo "<td>" . (!empty($project['tags']) ? $project['tags'] : '--') . "</td>";
                            echo "<td class='status'><span class='status-badge $statusClass'>" . (!empty($project['status']) ? $project['status'] : '--') . "</span></td>";
                            echo "<td>" . (!empty($project['team_member']) ? $project['team_member'] : '--') . "</td>";
                            echo "<td>" . (!empty($project['date_created']) ? $project['date_created'] : '--') . "</td>";
                            echo "<td>" . (!empty($project['sales_person']) ? $project['sales_person'] : '--') . "</td>";
                            echo "<td class='manager'>" . (!empty($project['manager']) ? $project['manager'] : '--') . "</td>";
                            echo "<td>" . (!empty($project['due_date']) ? $project['due_date'] : '--') . "</td>";
                            echo "<td>
                                <a href='EditProject.php?Id=" . $project['id'] . "'><img src='./public/assets/edit.svg' alt=''></a>
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                <a href='DeleteProject.php?Id=" . $project['id'] . "' onclick=\"return confirm('Are you sure?');\">
                                    <img src='./public/assets/delete.svg' alt=''>
                                </a>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11'>No projects found</td></tr>";
                    }

                    mysqli_close($conn);
                    ?>

                </tbody>
            </table>
        </div>
    </div>




    <div class="popup-overlay" onclick="closePopup()"></div>
    <div class="popup-form">

        <form action="ProjectData.php" method="POST">
            <div class="form-input">
                <input type="text" class="form-control" id="project_name" name="project_name"
                    placeholder="Project name">
                <label for="project_name" class="form-label">Project Name</label>

            </div>
            <?php
            // get the client name from client_primaryinfo table
            include "partials/sql-connction.php";

            $query = "SELECT client_id, client_name FROM client_primaryinfo ORDER BY client_name ASC";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                echo '<div class="form-input">';
                echo '<select class="form-control" id="client_id" name="client_id" >'; // Changed name to client_id
                echo '<option value="">Select Client</option>'; // Default option
            
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['client_id'] . '">' . htmlspecialchars($row['client_name']) . '</option>';
                }

                echo '</select>';
                echo '</div>';
            } else {
                echo '<div class="form-input">';
                echo '<p>No clients found.</p>';
                echo '</div>';
            }

            $conn->close();
            ?>

            <h4 style="margin-bottom: 1rem;">Description</h4>
            <div class="form-input-des item6" style="margin-bottom: 20px;">
                <input type="hidden" name="texteditor" id="texteditor-hidden-project-0o123">
                <div class="wsyig" id="wsyigProject-0o123"></div>
            </div>


            <div class="tags-input" id="projectTagsDiv">
                <input type="hidden" id="project_tags" name="project_tags">
                <ul>
                    <input type="text" id="projectTags" name="project_tags" placeholder="Tags">
                </ul>
            </div>


            <div class="custom-select">
                <select name="status" id="status">
                    <option value="Todo">Todo</option>
                    <option value="In Progress">In Progress</option>
                    <option value="On Hold">On hold</option>
                    <option value="Waiting on Client">Waiting on Client</option>
                    <option value="Canceled">Canceled</option>
                    <option value="Completed'">Completed</option>
                </select>
            </div>

            <!-- Take this from kishan Timesheet -->
            <div class="form-input">
                <input type="text" class="form-control" id="team_member" name="team_member" placeholder="Team Members">
                <label for="team_member" class="form-label">Team Members</label>
            </div>
            <div class="form-input">
                <input type="text" class="form-control" id="sales_person" name="sales_person"
                    placeholder="Sales Person">
                <label for="sales_person" class="form-label">Sales Person</label>
            </div>
            <div class="form-input">
                <input type="text" class="form-control" id="manager" name="manager" placeholder="Manager">
                <label for="manager" class="form-label">Manager</label>
            </div>
            <div class="form-input">
                <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Due Date">
                <label for="due_date" class="form-label">Due Date</label>
            </div>
            <div class="form-input">
                <input type="number" id="project_due_days" name="project_due_days" placeholder="Due days from creation"
                    required />
                <label for="project_due_days">Due days from creation</label>
            </div>
            <div class="custom-select">
                <select name="project_recurrence" id="project_recurrence">
                    <option value="None">Select Recurrence</option>
                    <option value="Daily">Daily</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Monthly">Monthly</option>
                </select>
            </div>

            <div class="btn-container-popup">
                <button type="submit" class="save-btn-0po90" id="projectSaveBtn-11pr44">Save</button>
                <button type="button" class="cancle-btn-0po90" onclick="closePopup()">Cancel</button>
            </div>
        </form>
    </div>

    <div class="popup-overlay" onclick="closeProjectTemplatePopup()"></div>
    <div class="popup-form-project-template-12pl0">

        <form>
            <?php
            // Assuming $conn is your database connection (from sql-connction.php or similar)
            include "partials/sql-connction.php";

            // Fetch project templates from the database
            $templateQuery = "SELECT id, name FROM project_template";
            $templateResult = mysqli_query($conn, $templateQuery);

            // Check if there are templates
            if (mysqli_num_rows($templateResult) > 0) {
                echo '<div class="form-input">';
                echo '<select class="form-control" id="templateSelect" name="client_id" required>'; // Changed name to client_id
                echo '<option value="">Select a Template</option>';
                while ($templateRow = mysqli_fetch_assoc($templateResult)) {
                    echo '<option value="' . $templateRow['id'] . '">' . htmlspecialchars($templateRow['name']) . '</option>';
                }

                echo '</select>';
                echo '</div>';
            } else {
                echo '<div class="form-input">';
                echo '<p>No clients found.</p>';
                echo '</div>';
            }

            $conn->close();
            ?>

            <div class="btn-container-popup">

                <button type="button" id="createProjectFromSelected" class="save-btn-0po90">Save</button>
                <button type="button" class="cancle-btn-0po90" onclick="closeProjectTemplatePopup()">Cancel</button>
            </div>
        </form>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./public/js/TagInput.js"></script>
    <script src="./public/js/Common/TextEditor.js"></script>
    <script>
        new TextEditor("wsyigProject-0o123", "texteditor-hidden-project-0o123");
        new TagsInput("projectTagsDiv", "project_tags");
    </script>
    <script src="./public/js/ProjectTab/project.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const createProjectFromSelected = document.getElementById('createProjectFromSelected');
            const templateSelect = document.getElementById('templateSelect');

            if (createProjectFromSelected && templateSelect) {
                createProjectFromSelected.addEventListener('click', function () {
                    const templateId = templateSelect.value;
                    if (templateId) {
                        // alert(templateId);
                        // Send an AJAX request to create the project from the template
                        fetch('create_project_from_template.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'template_id=' + templateId
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    alert(data.message);
                                    window.location.reload(); // Reload to see the new project
                                } else {
                                    alert(data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An error occurred while creating the project.');
                            });
                    } else {
                        alert('Please select a template.');
                    }
                });
            }
        });

    </script>
    <script>
        var x, i, j, l, ll, selElmnt, a, b, c;
        x = document.getElementsByClassName("custom-select");
        l = x.length;
        for (i = 0; i < l; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            ll = selElmnt.length;

            // Create the selected item DIV
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);

            // Create the options container DIV
            b = document.createElement("DIV");
            b.setAttribute("class", "select-items select-hide");




            // Loop through all options in the original select element
            for (j = 0; j < ll; j++) {
                c = document.createElement("DIV");
                c.innerHTML = selElmnt.options[j].innerHTML;

                if (selElmnt.options[j].disabled) {
                    c.classList.add("disabled-option");
                    c.style.color = "#aaa";
                    c.style.pointerEvents = "none";
                }

                // Add click event to each option
                c.addEventListener("click", function (e) {
                    var y, i, k, s, h, sl, yl;
                    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                    sl = s.length;
                    h = this.parentNode.previousSibling;
                    for (i = 0; i < sl; i++) {
                        if (s.options[i].innerHTML == this.innerHTML) {
                            s.selectedIndex = i;
                            h.innerHTML = this.innerHTML;
                            y = this.parentNode.getElementsByClassName("same-as-selected");
                            yl = y.length;
                            for (k = 0; k < yl; k++) {
                                y[k].removeAttribute("class");
                            }
                            this.setAttribute("class", "same-as-selected");
                            break;
                        }
                    }
                    h.click();
                });
                b.appendChild(c);
            }
            x[i].appendChild(b);

            // Add event listener to toggle dropdown
            a.addEventListener("click", function (e) {
                e.stopPropagation();
                closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active");
            });
        }

        // Function to close all dropdowns
        function closeAllSelect(elmnt) {
            var x, y, i, xl, yl, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            xl = x.length;
            yl = y.length;
            for (i = 0; i < yl; i++) {
                if (elmnt == y[i]) {
                    arrNo.push(i)
                } else {
                    y[i].classList.remove("select-arrow-active");
                }
            }
            for (i = 0; i < xl; i++) {
                if (arrNo.indexOf(i)) {
                    x[i].classList.add("select-hide");
                }
            }
        }

        document.addEventListener("click", closeAllSelect);
    </script>

    <script>
        // Populate Status Dropdown dynamically
        var statuses = <?php echo json_encode(array_keys($statuses)); ?>;
        statuses.forEach(status => $(".filter-dropdown").append(`<option value="${status}">${status}</option>`));

        // Show/Hide Filters on Click
        $(".filter-header").click(function (event) {
            event.stopPropagation();
            $(".filter-input, .filter-dropdown").addClass("hidden");
            $(this).find(".filter-input, .filter-dropdown").removeClass("hidden").focus();
        });

        // Close filters when clicking outside
        $(document).click(() => $(".filter-input, .filter-dropdown").addClass("hidden"));

        // Search Filter
        $(".filter-input").on("keyup", function () {
            let value = $(this).val().toLowerCase();
            let filterClass = $(this).closest(".filter-header").data("filter");

            $(".project-row").each(function () {
                $(this).toggle($(this).find("." + filterClass).text().toLowerCase().includes(value));
            });
        });

        // Status Filter
        $(".filter-dropdown").on("change", function () {
            let value = $(this).val();
            $(".project-row").each(function () {
                $(this).toggle(value === "" || $(this).data("status") === value);
            });
        });
    </script>

    <script>
        // Function to show all items
        function showAllItems() {
            const rows = document.querySelectorAll('#project-table tbody tr');
            rows.forEach(row => {
                row.style.display = ''; // Show all rows
            });
        }

        // Function to filter by status (Group by Status)
        function groupByStatus() {
            const rows = document.querySelectorAll('#project-table tbody tr');
            const statusColumn = 3; // Status is in the 4th column (0-based index)

            // Create an object to store unique statuses
            let statuses = {};

            rows.forEach(row => {
                const status = row.cells[statusColumn].textContent.trim();
                statuses[status] = true;
            });

            // Show a dropdown to filter by status
            const filterContainer = document.querySelector('.filter-container');
            const statusDropdown = document.createElement('select');
            statusDropdown.classList.add('filter-dropdown');
            statusDropdown.innerHTML = `<option value="">All</option>`;

            // Populate the dropdown with available statuses
            Object.keys(statuses).forEach(status => {
                statusDropdown.innerHTML += `<option value="${status}">${status}</option>`;
            });

            // Append the dropdown to the filter container
            filterContainer.appendChild(statusDropdown);

            // Add an event listener to filter based on selected status
            statusDropdown.addEventListener('change', (event) => {
                const selectedStatus = event.target.value;
                filterByStatus(selectedStatus);
            });
        }

        // Function to filter rows based on status
        function filterByStatus(status) {
            const rows = document.querySelectorAll('#project-table tbody tr');
            rows.forEach(row => {
                const rowStatus = row.cells[3].textContent.trim();
                if (status === "" || rowStatus === status) {
                    row.style.display = ''; // Show matching row
                } else {
                    row.style.display = 'none'; // Hide non-matching row
                }
            });
        }

        // Function to filter out completed statuses
        function filterNotCompleted() {
            const rows = document.querySelectorAll('#project-table tbody tr');
            rows.forEach(row => {
                const rowStatus = row.cells[3].textContent.trim();
                if (rowStatus === "Completed") {
                    row.style.display = 'none'; // Hide completed items
                } else {
                    row.style.display = ''; // Show non-completed items
                }
            });
        }

        // Function to filter rows that are still in progress
        function filterInProgress() {
            const rows = document.querySelectorAll('#project-table tbody tr');
            rows.forEach(row => {
                const rowStatus = row.cells[3].textContent.trim();
                if (rowStatus === "In Progress") {
                    row.style.display = ''; // Show in-progress items
                } else {
                    row.style.display = 'none'; // Hide non-in-progress items
                }
            });
        }

        // Function to filter progress items (customized logic depending on your data)
        function filterProgressItems() {
            const rows = document.querySelectorAll('#project-table tbody tr');
            rows.forEach(row => {
                const progressColumn = 3; // Assuming progress is in the 5th column (adjust as needed)
                const progress = row.cells[progressColumn].textContent.trim();

                // Filter based on a specific value (e.g., "In Progress")
                if (progress === "In Progress") {
                    row.style.display = ''; // Show progress items
                } else {
                    row.style.display = 'none'; // Hide non-progress items
                }
            });
        }

        // Event listeners for filter buttons
        document.querySelector('.filter-btn[data-filter="all"]').addEventListener('click', showAllItems);
        document.querySelector('.filter-btn[data-filter="grouped-by-status"]').addEventListener('click', groupByStatus);
        document.querySelector('.filter-btn[data-filter="not-completed"]').addEventListener('click', filterNotCompleted);
        document.querySelector('.filter-btn[data-filter="in-progress"]').addEventListener('click', filterInProgress);
        document.querySelector('.filter-btn[data-filter="progress-items"]').addEventListener('click', filterProgressItems);
    </script>


    <?php
    include "partials/sql-connction.php";
    ?>