<?php
include 'core/clientFunctions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientName = $_POST['client_name'];
    $businessName = $_POST['business_name'];
    $websiteUrl = $_POST['website'];

    if (addClient($clientName, $businessName, $websiteUrl)) {
        echo "<script>alert('Client added successfully!'); window.location.href='Clients.php';</script>";
    } else {
        echo "Failed to add client.";
    }
}




// Include the database connection file
// include "partials/sql-connction.php";

// // Check if the form is submitted
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Get form data and sanitize inputs
//     $client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
//     $business_name = mysqli_real_escape_string($conn, $_POST['business_name']);
//     $website = mysqli_real_escape_string($conn, $_POST['website']);
//     //making sure that website is a valid url or not
//     // $website = trim($website);
//     // $website = strtolower($website);
//     // if (strpos($website, "http") === 0 || strpos($website, "https") === 0) {
//     //     // If it doesn't contain "www", add it
//     //     if (strpos($website, "www.") === false) {
//     //         $website = str_replace("http://", "http://www.", $website);
//     //         $website = str_replace("https://", "https://www.", $website);
//     //     }
//     // } else {
//     //     // Add "http://www." if not present
//     //     if (strpos($website, "www.") === false) {
//     //         $website = "http://www." . $website;
//     //     } else {
//     //         $website = "http://" . $website;
//     //     }
//     // }

//     // Check if the website ends with ".com" to avoid appending it multiple times
//     // if (!str_ends_with($website, ".com")) {
//     //     $website .= ".com";
//     // }
//     // Prepare the SQL query to insert data into the clients table
//     $sql = "INSERT INTO clients (client_name, business_name, website) VALUES ('$client_name', '$business_name', '$website')";

//     // Execute the query and handle errors
//     if (mysqli_query($conn, $sql)) {
//         echo "<script>alert('Client added successfully!'); window.location.href='Clients.php';</script>";
//     } else {
//         echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.history.back();</script>";
//     }
// }

// // Close the database connection
// mysqli_close($conn);


