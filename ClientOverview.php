<?php
include 'partials/navbar.php';
include "partials/sql-connction.php";

// Get Client ID from URL
$client_id = isset($_GET['Id']) ? intval($_GET['Id']) : 0;

// Get the client primary information from client_primaryinfo table
try {
    $stmt = $conn->prepare("
        SELECT *
        FROM client_primaryinfo
        WHERE client_id = ?;
    ");

    if (!$stmt) {
        throw new Exception($conn->error); // Handle prepare errors
    }

    $stmt->bind_param("i", $client_id); // "i" indicates integer
    $stmt->execute();

    $result = $stmt->get_result(); // Get the result set
    $clientDetails = $result->fetch_assoc(); // Fetch a single row as an associative array

    $stmt->close();
    $clientData = $clientDetails;

} catch (Exception $e) {
    echo "Error retrieving client details: " . $e->getMessage();

}

// Get the client hosting and domain information from client_domain_hosting table
try {
    $stmt = $conn->prepare("SELECT * FROM client_domain_hosting WHERE client_id = ?");
    if (!$stmt) {
        throw new Exception($conn->error);
    }

    $stmt->bind_param("i", $client_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc(); // Fetch the first row as an associative array

    $stmt->close();

    $clientHostingData = $data; // Return the fetched data (or null if not found)

} catch (Exception $e) {
    echo "Error getting domain/hosting info: " . $e->getMessage();

}

// Get the client images from client_uploads table
try {
    $upload_dir = "uploads/";

    $logo = $favicon = $primary = "";
    $gallery = [];

    $result = $conn->query("SELECT * FROM client_uploads WHERE client_id = $client_id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $logo = $row['logo'];
        $favicon = $row['favicon'];
        $primary = $row['primary_image'];
        $gallery = json_decode($row['gallery'], true) ?? [];
    }

    // $conn->close();
} catch (Exception $e) {
    echo "Error getting domain/hosting info: " . $e->getMessage();

}

try {
    $stmt = $conn->prepare("SELECT
                                        id,
                                        project_name,
                                        team_member,
                                        date_created AS start_date,
                                        due_date AS end_date,
                                        status
                                    FROM
                                        project
                                    WHERE
                                        client_id = ?");
    if (!$stmt) {
        throw new Exception($conn->error);
    }

    $stmt->bind_param("i", $client_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $clientProjectDetails = $result;
    $stmt->close();

} catch (Exception $e) {
    echo "Error getting domain/hosting info: " . $e->getMessage();

}
try {
    $stmt = $conn->prepare("SELECT
                                        *
                                    FROM
                                        client_subscriptions
                                    WHERE
                                        client_id = ?");
    if (!$stmt) {
        throw new Exception($conn->error);
    }

    $stmt->bind_param("i", $client_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $clientSubscriptionDetails = $result;
    $stmt->close();

} catch (Exception $e) {
    echo "Error getting domain/hosting info: " . $e->getMessage();

}

// echo "<pre>";
// print_r($clientData);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Overview</title>
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="public/css/tabs.css">
    <link rel="stylesheet" href="public/css/table.css">
    <link rel="stylesheet" href="public/css/clientoverview.css">
</head>

<body>

    <div class="container">

        <div class="client-overview-head-09yu78">
            <div class="inner-container-09yu78">
                <a href="Clients.php" class="back-arrow-btn">
                    <img src="./public/assets/backarrow.svg" alt="">
                </a>
                <div>
                    <label>Client Name : </label>
                    <span><?php echo $clientData["client_name"]; ?></span>
                </div>
                <div>
                    <label>Client Id :</label>
                    <span><?php echo $client_id; ?></span>
                </div>
            </div>
        </div>
        <div class="tabs-outer-main-9056ty">
            <div class="tabs-inner-sub-9056ty">
                <ul class="tabs">
                    <li class="tab active" data-tab="tab1">Overview</li>
                    <li class="tab" data-tab="tab2">Hosting & Domain</li>
                    <li class="tab" data-tab="tab3">Hours</li>
                    <li class="tab" data-tab="tab4">Images</li>
                    <li class="tab" data-tab="tab5">Social</li>
                </ul>
            </div>
        </div>


        <div class="tab-content">
            <div id="tab1" class="tab-pane active">
                <!-- Client Details -->
                <div class="client-details-container">
                    <div class="client-header">
                        <h2 class="client-title">
                            <span class="client-title-prefix">BUSINESS DETAILS</span>
                            <a href="AddClient.php?Id=<?php echo $client_id; ?>"><img src='./public/assets/edit.svg'
                                    alt='edit'></a>
                        </h2>
                        <div class="btn-container-popup">
                            <button id="expandButton-8897ijk" class="save-btn-0po90">Expand</button>
                        </div>
                    </div>

                    <div class="client-details-grid showDiv" id="client-business-div-88kijs7">
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Business Name : </label>
                            <span class="class='client-detail-value'"><?php echo $clientData["business_name"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Business Category : </label>
                            <span
                                class="class='client-detail-value'"><?php echo $clientData["business_category"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Business Number : </label>
                            <span
                                class="class='client-detail-value'"><?php echo $clientData["business_number"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Website : </label>
                            <span class="class='client-detail-value'"><?php echo $clientData["website"]; ?></span>
                        </div>

                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Short Description : </label>
                            <span
                                class="class='client-detail-value'"><?php echo $clientData["short_description"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Long Description : </label>
                            <span
                                class="class='client-detail-value'"><?php echo $clientData["long_description"]; ?></span>
                        </div>


                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Other Business Number : </label>
                            <span
                                class="class='client-detail-value'"><?php echo $clientData["other_business_number"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Address:</label>
                            <span class='client-detail-value'><?php echo $clientData["address"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Country:</label>
                            <span class='client-detail-value'><?php echo $clientData["country"]; ?></span>
                        </div>

                        <div class='client-detail-item'>
                            <label class='client-detail-label'>City:</label>
                            <span class='client-detail-value'><?php echo $clientData["city"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>State:</label>
                            <span class='client-detail-value'><?php echo $clientData["state"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Zip Code:</label>
                            <span class='client-detail-value'><?php echo $clientData["zip_code"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Time Zone:</label>
                            <span class='client-detail-value'><?php echo $clientData["time_zone"]; ?></span>
                        </div>
                    </div>
                </div>
                <div class="client-project-453pli">
                    <div class="client-proj-inner-453pli">
                        <div class="client-project-list-453pli">
                            <div class="table-container">
                                <div class="table-inner-container">
                                    <div class="table-header-453pli">
                                        <span>Projects</span>
                                    </div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Project Name</th>
                                                <th>Team Member</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $statuses = [
                                                "Pending" => "status-pending",
                                                "In Progress" => "status-in-progress",
                                                "Completed" => "status-completed",
                                                "On Hold" => "status-on-hold",
                                            ];
                                            if ($clientProjectDetails && $clientProjectDetails->num_rows > 0) {
                                                while ($row = $clientProjectDetails->fetch_assoc()) {
                                                    $statusClass = isset($statuses[$row['status']]) ? $statuses[$row['status']] : "status-default";
                                                    echo "<tr>";
                                                    echo "<td><a href='ProjectOverview.php?Id=" . $row['id'] . "'>" . htmlspecialchars($row['project_name']) . "</a></td>";
                                                    echo "<td>" . htmlspecialchars($row['team_member']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['start_date']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['end_date']) . "</td>";
                                                    echo "<td class='status'><span class='status-badge $statusClass'>" . htmlspecialchars($row['status']) . "</span></td>";
                                                    // echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='5'>No projects found for this client.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="client-project-list-453pli">
                            <div class="table-container">
                                <div class="table-inner-container">
                                    <div class="table-header-453pli">
                                        <span>Subscriptions</span>
                                    </div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Subscription</th>
                                                <th>Status</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $statuses = [
                                                "Pending" => "status-pending",
                                                "In Progress" => "status-in-progress",
                                                "Completed" => "status-completed",
                                                "On Hold" => "status-on-hold",
                                            ];
                                            if ($clientSubscriptionDetails && $clientSubscriptionDetails->num_rows > 0) {
                                                while ($row = $clientSubscriptionDetails->fetch_assoc()) {
                                                    $statusClass = isset($statuses[$row['subscription_status']]) ? $statuses[$row['subscription_status']] : "status-default";
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($row['subscription_plan']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['subscription_status']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['subscription_start_date']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['subscription_end_date']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['subscription_price']) . "</td>";
                                                    // echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='5'>No projects found for this client.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="client-project-task-list-div-453pli">

                        <div class="client-project-task-list-453pli">
                            <div class="table-container">
                                <div class="table-inner-container">
                                    <div class="table-header-453pli">
                                        <span>Tasks</span>
                                        <?php
                                        // Project Selection Dropdown
                                        if ($clientProjectDetails && $clientProjectDetails->num_rows > 0) {
                                            echo '<select id="projectSelect" onchange="updateTasks()">';
                                            $clientProjectDetails->data_seek(0); // Reset result pointer
                                            $firstProjectId = null;
                                            while ($row = $clientProjectDetails->fetch_assoc()) {
                                                if ($firstProjectId === null) {
                                                    $firstProjectId = $row['id'];
                                                }
                                                echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['project_name']) . '</option>';
                                            }
                                            echo '</select>';
                                        }
                                        ?>
                                    </div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Task Name</th>
                                                <th>Assignee</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="taskTableBody">
                                            <?php
                                            $statuses = [
                                                "Pending" => "status-pending",
                                                "In Progress" => "status-in-progress",
                                                "Completed" => "status-completed",
                                                "On Hold" => "status-on-hold",
                                                "Not Started" => "status-not-started",
                                            ];
                                            // Display tasks for the first project (or no tasks if no projects)
                                            if ($clientProjectDetails && $clientProjectDetails->num_rows > 0) {
                                                $selectedProjectId = $firstProjectId; // Use the first project's ID
                                                try {
                                                    $stmt = $conn->prepare("SELECT task_name, assigned_to, start_date, due_date, status FROM project_tasks WHERE project_id = ?");
                                                    if (!$stmt) {
                                                        throw new Exception($conn->error);
                                                    }
                                                    $stmt->bind_param("i", $selectedProjectId);
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
                                                    echo "Error getting tasks: " . $e->getMessage();
                                                }
                                            } else {
                                                echo "<tr><td colspan='5'>No projects found.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div id="tab2" class="tab-pane">

                <div class="client-details-container">

                    <div class="client-header">
                        <h2 class="client-title">
                            <span class="client-title-prefix">HOSTING & DOMAIN :</span>
                        </h2>
                    </div>

                    <div class="client-details-grid">
                        <!-- Hosting Details -->
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Hosting Provider: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['hosting_provider']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Hosting Plan: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['hosting_plan'] ?: 'N/A'; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Hosting Start Date: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['hosting_start_date']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Hosting Renewal Date: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['hosting_renewal_date']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Hosting Cost: </label>
                            <span class="client-detail-value"><?php echo $clientHostingData['hosting_cost']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>IP Address: </label>
                            <span class="client-detail-value"><?php echo $clientHostingData['ip_address']; ?></span>
                        </div>

                        <!-- SSL Details -->
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>SSL Provider: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['ssl_provider'] ?: 'N/A'; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>SSL Expiry Date: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['ssl_expiry_date']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>SSL Total Amount Due: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['ssl_total_amount_due']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>SSL Payment Method: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['ssl_payment_method']; ?></span>
                        </div>

                        <!-- Domain Details -->
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Domain Name: </label>
                            <span class="client-detail-value"><?php echo $clientHostingData['domain_name']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Domain Registration Date: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['domain_registration_date']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Domain Expiry Date: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['domain_expiry_date']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Domain Cost: </label>
                            <span class="client-detail-value"><?php echo $clientHostingData['domain_cost']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Domain Payment Method: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['domain_payment_method'] ?: 'N/A'; ?></span>
                        </div>
                    </div>
                </div>

            </div>
            <div id="tab3" class="tab-pane">
                <h2>Tab 3 Content</h2>
                <p>This is the content for Tab 3.</p>
            </div>
            <div id="tab4" class="tab-pane">
                <div class="client-details-container">

                    <div class="client-header">
                        <h2 class="client-title">
                            <span class="client-title-prefix">IMAGES :</span>
                        </h2>
                    </div>

                    <div class="client-details-grid">
                        <!-- Images Details -->
                        <div class="client-detail-item">
                            <label class='client-detail-label'>Logo: </label>
                            <div class="preview" id="logo-preview">
                                <?php if ($logo)
                                    echo "<img src='$upload_dir$logo' width='100'>";
                                else
                                    echo "No Image"; ?>
                            </div>
                        </div>
                        <div class="client-detail-item">
                            <label class='client-detail-label'>Favicon: </label>
                            <div class="preview" id="logo-preview">
                                <?php if ($favicon)
                                    echo "<img src='$upload_dir$favicon' width='100'>";
                                else
                                    echo "No Image"; ?>
                            </div>
                        </div>
                        <div class="client-detail-item">
                            <label class='client-detail-label'>Primary: </label>
                            <div class="preview" id="logo-preview">
                                <?php if ($primary)
                                    echo "<img src='$upload_dir$primary' width='100'>";
                                else
                                    echo "No Image"; ?>
                            </div>
                        </div>

                        <div class="client-detail-item">
                            <label class='client-detail-label'>Gallery: </label>
                            <div class="preview-multiple" id="gallery-preview">
                                <?php
                                if (!empty($gallery)) {
                                    foreach ($gallery as $img) {
                                        echo "<img src='$upload_dir$img' width='100' style='margin-right:10px;'>";
                                    }
                                } else {
                                    echo "No Images";
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div id="tab5" class="tab-pane">
                <div class="client-details-container">

                    <div class="client-header">
                        <h2 class="client-title">
                            <span class="client-title-prefix">SOCIAL LINKS</span>
                        </h2>
                    </div>

                    <div class="client-details-grid">
                        <!-- Hosting Details -->
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Facebook: </label>
                            <span class="client-detail-value"><?php echo $clientData['facebook']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Twitter: </label>
                            <span class="client-detail-value"><?php echo $clientData['twitter'] ?: 'N/A'; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Instagram: </label>
                            <span class="client-detail-value"><?php echo $clientData['instagram']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Linked In: </label>
                            <span class="client-detail-value"><?php echo $clientData['linkedin']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Youtube: </label>
                            <span class="client-detail-value"><?php echo $clientData['youtube']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Custom Link: </label>
                            <span class="client-detail-value"><?php echo $clientData['custom_link']; ?></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Projects & Tasks Section -->


    </div>


    <script src="public/js/tabs.js"></script>
    <script>
        const clientBusinessDiv = document.getElementById('client-business-div-88kijs7');
        console.log(clientBusinessDiv.style.display);

        document.addEventListener('DOMContentLoaded', function () {
            const targetDiv = document.getElementById('client-business-div-88kijs7');
            const expandButton = document.getElementById('expandButton-8897ijk'); // Assuming you have an expand button with this ID

            if (clientBusinessDiv && expandButton) {
                expandButton.addEventListener('click', function () {
                    if (targetDiv.classList.contains('showDiv')) {
                        targetDiv.classList.remove('showDiv');
                        this.textContent = 'Collapse'; // Change button text if needed
                    } else {
                        targetDiv.classList.add('showDiv');
                        this.textContent = 'Expand'; // Change button text if needed
                    }
                });
            }
        });

        function updateTasks() {
            var projectId = document.getElementById("projectSelect").value;
            var taskTableBody = document.getElementById("taskTableBody");

            // Use AJAX to fetch tasks for the selected project
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    taskTableBody.innerHTML = xhr.responseText;
                }
            };
            xhr.open("GET", "get_tasks.php?project_id=" + projectId, true);
            xhr.send();
        }
    </script>

</body>

</html>