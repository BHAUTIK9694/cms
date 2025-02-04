<?php
session_start();
include 'partials/sql-connection.php'; // Ensure this file has the correct database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = mysqli_real_escape_string($conn, $_POST['client_id']); // Get client_id from the form

    // Capture all form data
    $hosting_provider = mysqli_real_escape_string($conn, $_POST['hosting_provider']);
    $hosting_plan = mysqli_real_escape_string($conn, $_POST['hosting_plan']);
    $hosting_start_date = mysqli_real_escape_string($conn, $_POST['hosting_start_date']);
    $hosting_renewal_date = mysqli_real_escape_string($conn, $_POST['hosting_renewal_date']);
    $hosting_cost = mysqli_real_escape_string($conn, $_POST['hosting_cost']);
    $ip_address = mysqli_real_escape_string($conn, $_POST['ip_address']);
    $domain_name = mysqli_real_escape_string($conn, $_POST['domain_name']);
    $domain_registration_date = mysqli_real_escape_string($conn, $_POST['domain_registration_date']);
    $domain_expiry_date = mysqli_real_escape_string($conn, $_POST['domain_expiry_date']);
    $domain_cost = mysqli_real_escape_string($conn, $_POST['domain_cost']);
    $ssl_provider = mysqli_real_escape_string($conn, $_POST['ssl_provider']);
    $ssl_expiry_date = mysqli_real_escape_string($conn, $_POST['ssl_expiry_date']);
    $ssl_installation_date = mysqli_real_escape_string($conn, $_POST['ssl_installation_date']);
    $billing_frequency = mysqli_real_escape_string($conn, $_POST['billing_frequency']);
    $last_payment_date = mysqli_real_escape_string($conn, $_POST['last_payment_date']);
    $next_billing_date = mysqli_real_escape_string($conn, $_POST['next_billing_date']);
    $total_amount_due = mysqli_real_escape_string($conn, $_POST['total_amount_due']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

    // Check if data already exists for the given client_id
    $checkQuery = "SELECT * FROM clients WHERE Id = '$client_id'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // If the record exists, perform an update
        $query = "UPDATE clients SET 
            hosting_provider = '$hosting_provider', 
            hosting_plan = '$hosting_plan', 
            hosting_start_date = '$hosting_start_date', 
            hosting_renewal_date = '$hosting_renewal_date', 
            hosting_cost = '$hosting_cost', 
            ip_address = '$ip_address',
            domain_name = '$domain_name', 
            domain_registration_date = '$domain_registration_date', 
            domain_expiry_date = '$domain_expiry_date', 
            domain_cost = '$domain_cost',
            ssl_provider = '$ssl_provider', 
            ssl_expiry_date = '$ssl_expiry_date', 
            ssl_installation_date = '$ssl_installation_date',
            billing_frequency = '$billing_frequency', 
            last_payment_date = '$last_payment_date', 
            next_billing_date = '$next_billing_date', 
            total_amount_due = '$total_amount_due', 
            payment_method = '$payment_method'
            WHERE Id = '$client_id'"; // Correct column name for client_id

        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Client details updated successfully!";
        } else {
            $_SESSION['error'] = "Error updating client details: " . mysqli_error($conn);
        }
    } else {
        // If no existing record, insert a new one with the specific client_id
        $query = "INSERT INTO clients (
            Id,
            hosting_provider, hosting_plan, hosting_start_date, hosting_renewal_date, hosting_cost, ip_address,
            domain_name, domain_registration_date, domain_expiry_date, domain_cost,
            ssl_provider, ssl_expiry_date, ssl_installation_date,
            billing_frequency, last_payment_date, next_billing_date, total_amount_due, payment_method
        ) VALUES (
            '$client_id', '$hosting_provider', '$hosting_plan', '$hosting_start_date', '$hosting_renewal_date', '$hosting_cost', '$ip_address',
            '$domain_name', '$domain_registration_date', '$domain_expiry_date', '$domain_cost',
            '$ssl_provider', '$ssl_expiry_date', '$ssl_installation_date',
            '$billing_frequency', '$last_payment_date', '$next_billing_date', '$total_amount_due', '$payment_method'
        )";

        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "New client details added successfully!";
        } else {
            $_SESSION['error'] = "Error adding client details: " . mysqli_error($conn);
        }
    }

    // Redirect after operation
    header("Location: Hosting.php"); // Make sure this matches your redirect page
    exit();
}

// Close connection
$conn->close();
