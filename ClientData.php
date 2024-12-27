<?php
// Include the database connection file
include "partials/sql-connction.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize inputs
    $client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $business_name = mysqli_real_escape_string($conn, $_POST['business_name']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);

    // Prepare the SQL query to insert data into the clients table
    $sql = "INSERT INTO clients (client_name, business_name, website) VALUES ('$client_name', '$business_name', '$website')";

    // Execute the query and handle errors
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Client added successfully!'); window.location.href='Clients.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }
}

// Close the database connection
mysqli_close($conn);
?>
