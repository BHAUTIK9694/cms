<?php
// Include the database connection
include 'partials/sql-connction.php';

// Check if the 'Id' parameter is passed in the URL
if (isset($_GET['Id'])) {
    $client_id = mysqli_real_escape_string($conn, $_GET['Id']);

    // Delete the client from the clients table
    $query = "DELETE FROM clients WHERE Id = '$client_id'";

    if (mysqli_query($conn, $query)) {
        // Redirect to the client page after deletion
        header("Location: Clients.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
