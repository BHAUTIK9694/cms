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

    if (!$result) {
        die("Error fetching client details: " . mysqli_error($conn));
    }

    $client = mysqli_fetch_assoc($result);

    if (!$client) {
        echo "Client ID not found!";
        exit();
    }

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
        }

        .container {
            width: 90%;
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

        .details-section {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 20px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 10px;
        }

        .details-grid p {
            margin: 0;
            padding: 5px;
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
        <header class="header">
            <a href="clients_list.php" class="back-btn">⬅ Back</a>
            <input type="text" placeholder="Client Name" value="<?php echo htmlspecialchars($client['business_name']); ?>" readonly>
        </header>

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
                <?php foreach ($client as $key => $value) {
                    if (!empty($value)) { ?>
                        <p><strong><?php echo ucfirst(str_replace('_', ' ', $key)); ?>:</strong> <?php echo htmlspecialchars($value); ?></p>
                <?php }
                } ?>
            </div>
        </section>

        <!-- Tasks Section -->
        <section class="details-section">
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

</body>

</html>