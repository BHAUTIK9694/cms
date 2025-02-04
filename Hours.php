<?php
session_start(); // Start the session

include "partials/sql-connction.php";


// If 'Id' is provided in the URL, update session
if (isset($_GET['Id'])) {
    $_SESSION['clientId'] = $_GET['Id'];
}

// Retrieve clientId from session
$clientId = isset($_SESSION['clientId']) ? $_SESSION['clientId'] : '';

// Default tab
$name = isset($_GET['tab']) ? $_GET['tab'] : 'Hours';

// Handle form submission to update working hours
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $monday_active = isset($_POST['monday_active']) ? 1 : 0;
    $monday_start = mysqli_real_escape_string($conn, $_POST['monday_start']);
    $monday_end = mysqli_real_escape_string($conn, $_POST['monday_end']);
    $tuesday_active = isset($_POST['tuesday_active']) ? 1 : 0;
    $tuesday_start = mysqli_real_escape_string($conn, $_POST['tuesday_start']);
    $tuesday_end = mysqli_real_escape_string($conn, $_POST['tuesday_end']);
    $wednesday_active = isset($_POST['wednesday_active']) ? 1 : 0;
    $wednesday_start = mysqli_real_escape_string($conn, $_POST['wednesday_start']);
    $wednesday_end = mysqli_real_escape_string($conn, $_POST['wednesday_end']);
    $thursday_active = isset($_POST['thursday_active']) ? 1 : 0;
    $thursday_start = mysqli_real_escape_string($conn, $_POST['thursday_start']);
    $thursday_end = mysqli_real_escape_string($conn, $_POST['thursday_end']);
    $friday_active = isset($_POST['friday_active']) ? 1 : 0;
    $friday_start = mysqli_real_escape_string($conn, $_POST['friday_start']);
    $friday_end = mysqli_real_escape_string($conn, $_POST['friday_end']);
    $saturday_active = isset($_POST['saturday_active']) ? 1 : 0;
    $saturday_start = mysqli_real_escape_string($conn, $_POST['saturday_start']);
    $saturday_end = mysqli_real_escape_string($conn, $_POST['saturday_end']);
    $sunday_active = isset($_POST['sunday_active']) ? 1 : 0;
    $sunday_start = mysqli_real_escape_string($conn, $_POST['sunday_start']);
    $sunday_end = mysqli_real_escape_string($conn, $_POST['sunday_end']);

    // Update working hours in the database
    $query = "
        UPDATE clients SET 
            monday_active = '$monday_active', monday_start = '$monday_start', monday_end = '$monday_end',
            tuesday_active = '$tuesday_active', tuesday_start = '$tuesday_start', tuesday_end = '$tuesday_end',
            wednesday_active = '$wednesday_active', wednesday_start = '$wednesday_start', wednesday_end = '$wednesday_end',
            thursday_active = '$thursday_active', thursday_start = '$thursday_start', thursday_end = '$thursday_end',
            friday_active = '$friday_active', friday_start = '$friday_start', friday_end = '$friday_end',
            saturday_active = '$saturday_active', saturday_start = '$saturday_start', saturday_end = '$saturday_end',
            sunday_active = '$sunday_active', sunday_start = '$sunday_start', sunday_end = '$sunday_end'
        WHERE Id = '$clientId'
    ";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Working hours updated successfully!'); window.location.href = 'hours.php?Id=$clientId';</script>";
    } else {
        echo "<script>alert('Error updating working hours: " . mysqli_error($conn) . "');</script>";
    }
}

// Fetch the existing working hours for the client from the database
$query = "SELECT * FROM clients WHERE Id = '$clientId'";
$result = mysqli_query($conn, $query);
$client_data = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hours</title>
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F1F1EC;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            color: #007474;
        }

        .working-hour-section {
            width: 90%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007474;
            color: white;
        }

        input[type="time"],
        input[type="checkbox"] {
            padding: 5px;
            margin-right: 10px;
        }

        .app-all {
            background-color: #007474;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .app-all:hover {
            background-color: #007474c3;
        }
    </style>
</head>

<body>
    <?php
    include 'partials/navbar.php';
    include 'partials/AddClientNav.php';
    ?>
    <h1><?php echo $clientId ?></h1>
    <form method="POST" action="hours.php?Id=<?php echo $clientId; ?>">
        <section class="working-hour-section">
            <input type="hidden" id="client-id" name="client_id" value="<?php echo $clientId; ?>" required>
            <table>
                <tr>
                    <th>Day</th>
                    <th>Enable</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Actions</th>
                </tr>

                <?php
                $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                foreach ($days as $day) {
                    echo "<tr>
                        <td>" . ucfirst($day) . "</td>
                        <td><input type='checkbox' name='{$day}_active' " . ($client_data[$day . '_active'] ? 'checked' : '') . "></td>
                        <td><input type='time' name='{$day}_start' value='" . $client_data[$day . '_start'] . "'></td>
                        <td><input type='time' name='{$day}_end' value='" . $client_data[$day . '_end'] . "'></td>
                        <td><button type='button' class='app-all' onclick='applyTimesToAll(\"$day\")'>Apply to All</button></td>
                    </tr>";
                }
                ?>

            </table>
            <button type="submit" class="app-all">Save Working Hours</button>
        </section>
    </form>
</body>

<script>
    // Function to toggle day inputs based on checkbox state
    function toggleDay(day) {
        const checkbox = document.getElementById(day + '_active');
        const startInput = document.getElementById(day + '_start');
        const endInput = document.getElementById(day + '_end');

        if (checkbox.checked) {
            startInput.disabled = false;
            endInput.disabled = false;
        } else {
            startInput.disabled = true;
            endInput.disabled = true;
        }
    }

    // Function to apply the selected day's times and availability to all other days
    function applyTimesToAll(day) {
        const startTime = document.getElementById(day + '_start').value;
        const endTime = document.getElementById(day + '_end').value;
        const isChecked = document.getElementById(day + '_active').checked;

        const days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        days.forEach(function(currentDay) {
            if (currentDay !== day) {
                document.getElementById(currentDay + '_start').value = startTime;
                document.getElementById(currentDay + '_end').value = endTime;

                const checkbox = document.getElementById(currentDay + '_active');
                checkbox.checked = isChecked;
                toggleDay(currentDay);
            }
        });
    }
</script>

</html>