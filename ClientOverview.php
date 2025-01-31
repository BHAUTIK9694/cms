<?php
include 'partials/navbar.php';
include 'partials/AddClientNav.php';
include "partials/sql-connction.php";

// Get Client ID from URL
$client_id = isset($_GET['Id']) ? intval($_GET['Id']) : 0;

if ($client_id > 0) {
    // Fetch client details from the clients table
    $sql = "SELECT * FROM clients WHERE Id = $client_id";
    $result = mysqli_query($conn, $sql);
    $client = mysqli_fetch_assoc($result);

    // Check if client exists
    if (!$client) {
        echo "Client ID not found!";
        exit();
    }

    $sql_tasks = "SELECT * FROM Clients WHERE Id = $client_id";
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
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin: auto;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .client-name {
            font-size: 20px;
            font-weight: bold;
        }

        .tabs {
            display: flex;
            gap: 15px;
            margin: 20px 0;
        }

        .tabs a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .business-details,
        .tasks {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .overdue {
            color: red;
            font-weight: bold;
        }

        .overdue {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <header class="header">
            <a href="clients_list.php">⬅ Back</a>
            <span class="client-name"><?php echo $client['business_name']; ?></span>
        </header>

        <section class="business-details">
            <h2>Business Details</h2>
            <p><strong>Address:</strong> <?php echo $client['address']; ?></p>
            <p><strong>Website:</strong> <a href="<?php echo $client['website']; ?>" target="_blank"><?php echo $client['website']; ?></a></p>
            <p><strong>Phone:</strong> <?php echo $client['phone']; ?></p>
            <p><strong>Short Description:</strong> <?php echo $client['short_description']; ?></p>
        </section>

        <section class="tasks">
            <h2>Tasks</h2>
            <table>
                <tr>
                    <th>Task Name</th>
                    <th>Details</th>
                </tr>
                <?php while ($task = mysqli_fetch_assoc($tasks)) { ?>
                    <tr>
                        <td>Task Name</td>
                        <td><?php echo $task['task_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Assignee</td>
                        <td><?php echo $task['assignee']; ?></td>
                    </tr>
                    <tr>
                        <td>Start Date</td>
                        <td><?php echo $task['start_date']; ?></td>
                    </tr>
                    <tr>
                        <td>End Date</td>
                        <td>
                            <?php
                            $task_end_date = $task['end_date'];
                            echo $task_end_date;
                            if (strtotime($task_end_date) < time()) {
                                echo ' <span class="overdue">OVERDUE</span>';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?php echo $task['status']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr>
                        </td>
                    </tr> <!-- Add a separator between tasks -->
                <?php } ?>
            </table>
        </section>

    </div>

</body>

</html>