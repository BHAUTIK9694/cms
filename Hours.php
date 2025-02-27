<?php
// session_start(); // Start the session

include "partials/sql-connction.php";


// If 'Id' is provided in the URL, update session
if (isset($_GET['Id'])) {
    $_SESSION['clientId'] = $_GET['Id'];
}

// Retrieve clientId from session
$clientId = isset($_SESSION['clientId']) ? $_SESSION['clientId'] : '';

// Default tab
// $name = isset($_GET['tab']) ? $_GET['tab'] : 'Hours';

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
    // Update working hours in the database (Insert if not exists, otherwise update)
    $query = "
INSERT INTO clients (Id, monday_active, monday_start, monday_end, 
                     tuesday_active, tuesday_start, tuesday_end, 
                     wednesday_active, wednesday_start, wednesday_end, 
                     thursday_active, thursday_start, thursday_end, 
                     friday_active, friday_start, friday_end, 
                     saturday_active, saturday_start, saturday_end, 
                     sunday_active, sunday_start, sunday_end)
VALUES ('$clientId', '$monday_active', '$monday_start', '$monday_end',
        '$tuesday_active', '$tuesday_start', '$tuesday_end',
        '$wednesday_active', '$wednesday_start', '$wednesday_end',
        '$thursday_active', '$thursday_start', '$thursday_end',
        '$friday_active', '$friday_start', '$friday_end',
        '$saturday_active', '$saturday_start', '$saturday_end',
        '$sunday_active', '$sunday_start', '$sunday_end')
ON DUPLICATE KEY UPDATE 
    monday_active = VALUES(monday_active), monday_start = VALUES(monday_start), monday_end = VALUES(monday_end),
    tuesday_active = VALUES(tuesday_active), tuesday_start = VALUES(tuesday_start), tuesday_end = VALUES(tuesday_end),
    wednesday_active = VALUES(wednesday_active), wednesday_start = VALUES(wednesday_start), wednesday_end = VALUES(wednesday_end),
    thursday_active = VALUES(thursday_active), thursday_start = VALUES(thursday_start), thursday_end = VALUES(thursday_end),
    friday_active = VALUES(friday_active), friday_start = VALUES(friday_start), friday_end = VALUES(friday_end),
    saturday_active = VALUES(saturday_active), saturday_start = VALUES(saturday_start), saturday_end = VALUES(saturday_end),
    sunday_active = VALUES(sunday_active), sunday_start = VALUES(sunday_start), sunday_end = VALUES(sunday_end);
";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success_message'] = "Working hours updated successfully!";
        echo "<script>
    localStorage.setItem('successMessage', '" . $_SESSION['success_message'] . "');
    window.location.href = 'hours.php?Id=$clientId';
</script>";
        exit();
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
    <form method="POST">
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
                        <td><input type='checkbox' id='{$day}_active' name='{$day}_active' " . ($client_data[$day . '_active'] ? 'checked' : '') . "></td>
                        <td><input type='time' id='{$day}_start' name='{$day}_start' value='" . $client_data[$day . '_start'] . "'></td>
                        <td><input type='time' id='{$day}_end' name='{$day}_end' value='" . $client_data[$day . '_end'] . "'></td>
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
            document.getElementById(currentDay + '_start').value = startTime;
            document.getElementById(currentDay + '_end').value = endTime;

            const checkbox = document.getElementById(currentDay + '_active');
            checkbox.checked = isChecked;
        });
    }
</script>

</html>