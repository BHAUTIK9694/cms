<?php
include "partials/sql-connction.php";

if (isset($_GET['id'])) {
    $client_id = $_GET['id'];

    // Set subscription details to NULL instead of deleting the client record
    $query = "UPDATE clients SET 
        subscription_plan = NULL,
        subscription_status = NULL,
        subscription_start_date = NULL,
        subscription_end_date = NULL,
        subscription_price = NULL
        WHERE client_id = '$client_id'";

    if (mysqli_query($conn, $query)) {
        echo "Subscription deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: subscription.php"); // Redirect back to subscription page
}
