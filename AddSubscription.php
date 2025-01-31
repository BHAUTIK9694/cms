<?php
include 'partials/navbar.php';
include 'partials/AddClientNav.php';
include "partials/sql-connction.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_POST['Id'];
    $subscription_plan = $_POST['subscription_plan'];
    $subscription_status = $_POST['subscription_status'];
    $subscription_start_date = $_POST['subscription_start_date'];
    $subscription_end_date = $_POST['subscription_end_date'];
    $subscription_price = $_POST['subscription_price'];

    $query = "INSERT INTO clients (Id, subscription_plan, subscription_status, subscription_start_date, subscription_end_date, subscription_price) 
              VALUES ('$client_id', '$subscription_plan', '$subscription_status', '$subscription_start_date', '$subscription_end_date', '$subscription_price')";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Subscription added successfully!'); window.location.href='Subscription.php';</script>";
    } else {
        echo "<script>alert('Error adding subscription: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subscription</title>
    <link rel="shortcut icon" href="./public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-decoration: underline;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            border-radius: 5px;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Add Subscription</h2>

        <form method="POST">
            <div class="form-group">
                <label for="client_id">Client ID:</label>
                <input type="number" name="client_id" required>
            </div>

            <div class="form-group">
                <label for="subscription_plan">Subscription Plan:</label>
                <input type="text" name="subscription_plan" required>
            </div>

            <div class="form-group">
                <label for="subscription_status">Status:</label>
                <select name="subscription_status" required>
                    <option value="Active">Active</option>
                    <option value="Expired">Expired</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>

            <div class="form-group">
                <label for="subscription_start_date">Start Date:</label>
                <input type="date" name="subscription_start_date" required>
            </div>

            <div class="form-group">
                <label for="subscription_end_date">End Date:</label>
                <input type="date" name="subscription_end_date" required>
            </div>

            <div class="form-group">
                <label for="subscription_price">Price ($):</label>
                <input type="number" step="0.01" name="subscription_price" required>
            </div>

            <button type="submit">Add Subscription</button>
        </form>
    </div>
</body>

</html>