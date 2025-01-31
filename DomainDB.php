<?php
session_start();
include 'partials/sql-connection.php'; // Ensure this file has the correct database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_POST['client_id']; // Assuming the client_id is already available

    // Capture all form data
    $hosting_provider = $_POST['hosting_provider'];
    $hosting_plan = $_POST['hosting_plan'];
    $hosting_start_date = $_POST['hosting_start_date'];
    $hosting_renewal_date = $_POST['hosting_renewal_date'];
    $hosting_cost = $_POST['hosting_cost'];
    $ip_address = $_POST['ip_address'];

    $domain_name = $_POST['domain_name'];
    $domain_registration_date = $_POST['domain_registration_date'];
    $domain_expiry_date = $_POST['domain_expiry_date'];
    $domain_cost = $_POST['doman_cost'];

    $ssl_provider = $_POST['ssl_provider'];
    $ssl_expiry_date = $_POST['ssl_expiry_date'];
    $ssl_installation_date = $_POST['ssl_installation_date'];

    $billing_frequency = $_POST['billing_frequency'];
    $last_payment_date = $_POST['last_payment_date'];
    $next_billing_date = $_POST['next_billing_date'];
    $total_amount_due = $_POST['total_amount_due'];
    $payment_method = $_POST['payment_method'];

    // Update query to insert all data into the `clients` table
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
        WHERE client_id = '$client_id'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Client details updated successfully!";
        header("Location: AddDomainAndHosting.php"); // Redirect after success
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Close connection
$conn->close();
