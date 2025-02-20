<?php
include "partials/sql-connction.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $clientId = isset($_POST['client_id']) ? intval($_POST['client_id']) : 0;
    $subscriptionPlan = htmlspecialchars(strip_tags($_POST['subscription_plan']));
    $subscriptionStatus = htmlspecialchars(strip_tags($_POST['subscription_status']));
    $startDate = $_POST['subscription_start_date'];
    $endDate = $_POST['subscription_end_date'];
    $price = isset($_POST['subscription_price']) ? floatval($_POST['subscription_price']) : 0;

    // Basic Validation
    if ($clientId <= 0 || empty($subscriptionPlan) || empty($subscriptionStatus) || empty($startDate) || empty($endDate) || $price <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required and must be valid.']);
        $conn->close();
        exit;
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO client_subscriptions (client_id, subscription_plan, subscription_status, subscription_start_date, subscription_end_date, subscription_price) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("issssd", $clientId, $subscriptionPlan, $subscriptionStatus, $startDate, $endDate, $price);

        if ($stmt->execute()) {
            echo "<script>alert('Subscription details added successfully.'); </script>";
            // echo json_encode(['status' => 'success', 'message' => 'Subscription details added successfully.']);
            header("Location: AddClient.php?Id=" . $clientId);
        } else {
            echo "<script>alert('Error adding subscription details.'); </script>";
            echo json_encode(['status' => 'error', 'message' => 'Error adding subscription details: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error preparing statement: ' . $conn->error]);
    }

    
} else {

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./public/css/input.css">
    <style>
        .active-status {
            color: white;
            font-weight: bold;
            background-color: green;
            /* Light green background */
            padding: 3px 8px;
            /* Add some padding for better appearance */
            border-radius: 5px;
            /* Optional: Rounded corners */
        }

        .expired-status {
            color: white;
            font-weight: bold;
            background-color: red;
            /* Light red background */
            padding: 3px 8px;
            border-radius: 5px;
        }

        .cancelled-status {
            color: white;
            font-weight: bold;
            background-color: gray;
            /* Light gray background */
            padding: 3px 8px;
            border-radius: 5px;
        }

        .unknown-status {
            /* Optional: For unexpected statuses */
            color: white;
            font-weight: bold;
            background-color: orange;
            /* Light orange background */
            padding: 3px 8px;
            border-radius: 5px;
        }

        .subscription-btn-container {
            width: 100%;
            display: flex;
            justify-content: end;
            gap: 1rem;
        }

        .container {
            max-width: 100%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            width: 90%;
            text-align: center;
        }

        .subscription-head-container {
            width: 100%;
            display: flex;
            justify-content: baseline;
            align-items: center;
            gap: 20px;
        }

        /* Subscription Table */
        .subscription-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .subscription-table th,
        .subscription-table td {
            padding: 12px;
            text-align: center;
        }

        .subscription-table th {
            background-color: #007474;
            color: white;
            text-align: center;
            font-weight: bold;
        }

        .subscription-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Button */
        .popup-btn {
            width: 8rem;
            padding: 6px 3px;
            border-radius: 6px;
            font-size: large;
            background: #007474;
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;

        }

        .popup-btn:hover {
            background-color: #007474c3;
        }

        /* Popup Overlay */
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

        /* Popup Form */
        .popup-form {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            z-index: 1000;
            width: 400px;
        }

        .popup-form select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .popup-form .save-btn-902wer {
            width: 5rem;
            background-color: #007474;
            color: white;
            padding: 8px 12px;
            border: none;
            /* border-radius: 5px; */
            cursor: pointer;
            margin-top: 10px;
        }

        .popup-form .cancel-btn-980plok {
            width: 6rem;
            font-weight: bold;
            background-color: white;
            color: #007474;
            padding: 8px 12px;
            border: 1 px solid #007474;
            cursor: pointer;
            margin-top: 10px;
        }

        .popup-form .save-btn-902wer:hover {
            background-color: #005f5f;
        }

        .popup-form .cancel-btn-980plok:hover {
            background-color: #f1f1ec;
        }

        .cancel-btn {
            background-color: red;
        }

        .cancel-btn:hover {
            background-color: darkred;
        }
    </style>
</head>

<body>
    <div class="client-container-outer-674pl">
        <div style="width: 95%;">
            <div class="subscription-head-container">
                <h2>Manage Subscriptions</h2>

                <!-- Manage Subscription Button -->
                <button class="popup-btn" onclick="openPopup()">Add Subscription</button>

            </div>

            <!-- Subscription List -->
            <table class="subscription-table">
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Subscription</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "partials/sql-connction.php";
                    $query = "SELECT id, client_id, subscription_plan, subscription_status, subscription_start_date, subscription_end_date, subscription_price FROM client_subscriptions WHERE client_id ='$clientId'";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $status = $row['subscription_status'];
                            $statusClass = '';

                            switch ($status) {
                                case 'Active':
                                    $statusClass = 'active-status';
                                    break;
                                case 'Expired':
                                    $statusClass = 'expired-status';
                                    break;
                                case 'Cancelled':
                                    $statusClass = 'cancelled-status';
                                    break;
                                default:
                                    $statusClass = 'unknown-status';
                                    break;
                            }

                            echo "<tr>
                                <td>{$row['client_id']}</td>
                                <td>{$row['subscription_plan']}</td>
                                <td><span class='{$statusClass}'>{$status}</span></td>
                                <td>{$row['subscription_start_date']}</td>
                                <td>{$row['subscription_end_date']}</td>
                                <td>\${$row['subscription_price']}</td>
                                <td><a class='delete-btn' href='delete_subscription.php?id={$row['id']}'><i class='fas fa-trash-alt'></i></a></td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No subscriptions found.</td></tr>";
                    }

                    $conn->close();
                    ?>

                    
                </tbody>
            </table>
        </div>
    </div>

    <!-- Popup Form for Subscription -->
    <div class="popup-overlay" onclick="closePopup()"></div>
    <div class="popup-form">
        <h2>Add Subscription</h2>
        <form action="Subscription.php" method="POST">
            <input type="hidden" id="client-id" name="client_id" value="<?php echo $_GET["Id"]; ?>" required>
            <div class="form-input">
                <input type="text" name="subscription_plan" placeholder="Subscription Plan" required>
                <label for="subscription_plan">Subscription Plan:</label>
            </div>

            <div class="form-input">
                <!-- <label for="subscription_status">Status:</label> -->
                <select name="subscription_status" required>
                    <option value="Active">Active</option>
                    <option value="Expired">Expired</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>


            <div class="form-input">

                <input type="date" name="subscription_start_date" required>
                <label for="subscription_start_date">Start Date:</label>
            </div>

            <div class="form-input">

                <input type="date" name="subscription_end_date" required>
                <label for="subscription_end_date">End Date:</label>
            </div>

            <div class="form-input">

                <input type="number" step="0.01" name="subscription_price" placeholder="Price ($)" required>
                <label for="subscription_price">Price ($):</label>
            </div>

            <div class="subscription-btn-container">
                <button type="button" class="cancel-btn-980plok" onclick="closePopup()">Cancel</button>
                <button type="submit" class="save-btn-902wer">Save</button>
            </div>
        </form>
    </div>

    <script>
        function openPopup() {
            document.querySelector('.popup-overlay').style.display = 'block';
            document.querySelector('.popup-form').style.display = 'block';
        }

        function closePopup() {
            document.querySelector('.popup-overlay').style.display = 'none';
            document.querySelector('.popup-form').style.display = 'none';
        }
    </script>
</body>

</html>