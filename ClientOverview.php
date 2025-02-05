<?php
include 'partials/navbar.php';
include 'partials/AddClientNav.php';
include "partials/sql-connction.php";

// Get Client ID from URL
$client_id = isset($_GET['Id']) ? intval($_GET['Id']) : 0;

if ($client_id > 0) {
    // Fetch client details
    $sql = "SELECT * FROM clients WHERE Id = $client_id";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Error fetching client details: " . mysqli_error($conn));
    }
    $client = mysqli_fetch_assoc($result);

    if (!$client) {
        echo "Client ID not found!";
        exit();
    }

    // Fetch projects related to the client
    $sql_projects = "SELECT * FROM clients WHERE Id = $client_id";
    $projects = mysqli_query($conn, $sql_projects);

    // Fetch tasks related to the client
    $sql_tasks = "SELECT * FROM clients WHERE Id = $client_id";
    $tasks = mysqli_query($conn, $sql_tasks);
} else {
    echo "Client ID not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Overview</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 95%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .back-btn {
            text-decoration: none;
            font-size: 18px;
            color: black;
            font-weight: bold;
        }

        .tabs {
            display: flex;
            gap: 15px;
            margin: 20px 0;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .tabs a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 10px;
        }

        .tabs a:hover {
            color: #007bff;
        }

        /* Business Details */
        .details-section {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 20px;
            background: #f9f9f9;
        }

        .details-section h3 {
            margin: 0 0 10px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .details-grid p {
            margin: 0;
            padding: 5px;
            font-weight: bold;
        }

        .details-grid span {
            font-weight: normal;
            color: #555;
        }

        /* Projects & Tasks */
        .table-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
        }

        .table-wrapper {
            flex: 1;
            background: white;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .overdue {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Header -->
        <header class="header">
            <a href="Clients.php" class="back-btn">⬅ Back</a>
            <input type="text" placeholder="Client Name" value="<?php echo htmlspecialchars($client['business_name']); ?>" readonly>
        </header>

        <!-- Navigation Tabs -->
        <nav class="tabs">
            <a href="#">Overview</a>
            <a href="#">Hosting & Domain</a>
            <a href="#">Hours</a>
            <a href="#">Images</a>
            <a href="#">Social</a>
        </nav>

        <!-- Business Details -->
        <section class="details-section">
            <h3>Business Details</h3>
            <div class="details-grid">
                <p>Address: <span><?php echo htmlspecialchars($client['address']); ?></span></p>
                <p>Website: <span><?php echo htmlspecialchars($client['website']); ?></span></p>
                <p>Short Description: <span><?php echo htmlspecialchars($client['short_description']); ?></span></p>
                <p>Phone Number: <span><?php echo htmlspecialchars($client['phone']); ?></span></p>
                <p>Time Zone: <span><?php echo htmlspecialchars($client['time_zone']); ?></span></p>
                <p>Long Description: <span><?php echo htmlspecialchars($client['long_description']); ?></span></p>
                <p>Client ID: <span><?php echo htmlspecialchars($client['Id']); ?></span></p>
                <p>Tags: <span><?php echo htmlspecialchars($client['tags']); ?></span></p>
            </div>
        </section>

        <!-- Projects & Tasks Section -->
        <div class="table-container">
            <!-- Projects -->
            <section class="table-wrapper">
                <h3>Projects</h3>
                <table>
                    <tr>
                        <th>Project Name</th>
                        <th>Team Member</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                    <?php while ($project = mysqli_fetch_assoc($projects)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($project['project_name']); ?></td>
                            <td><?php echo htmlspecialchars($project['team_member']); ?></td>
                            <td><?php echo htmlspecialchars($project['start_date']); ?></td>
                            <td><?php echo htmlspecialchars($project['end_date']); ?></td>
                            <td><?php echo htmlspecialchars($project['status']); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </section>

            <!-- Tasks -->
            <section class="table-wrapper">
                <h3>Tasks</h3>
                <table>
                    <tr>
                        <th>Task Name</th>
                        <th>Assignee</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                    <?php while ($task = mysqli_fetch_assoc($tasks)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($task['task_name']); ?></td>
                            <td><?php echo htmlspecialchars($task['assignee']); ?></td>
                            <td><?php echo htmlspecialchars($task['start_date']); ?></td>
                            <td>
                                <?php
                                $task_end_date = $task['end_date'];
                                echo htmlspecialchars($task_end_date);
                                if (strtotime($task_end_date) < time()) {
                                    echo ' <span class="overdue">OVERDUE</span>';
                                }
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($task['status']); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </section>
        </div>

    </div>

</body>

</html>