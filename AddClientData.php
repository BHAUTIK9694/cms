<?php
// Include database connection
include "partials/sql-connction.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input data to avoid XSS or SQL Injection
    // $client_id = mysqli_real_escape_string($conn, $_POST['client_id']);
    $business_name = mysqli_real_escape_string($conn, $_POST['business_name']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $short_description = mysqli_real_escape_string($conn, $_POST['short_description']);
    $long_description = mysqli_real_escape_string($conn, $_POST['long_description']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $fax = mysqli_real_escape_string($conn, $_POST['fax']);
    $toll_free = mysqli_real_escape_string($conn, $_POST['toll_free']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip']);
    $time_zone = mysqli_real_escape_string($conn, $_POST['time_zone']);
    $map = mysqli_real_escape_string($conn, $_POST['map']);
    $booking_link = mysqli_real_escape_string($conn, $_POST['booking_link']);
    $business_category = mysqli_real_escape_string($conn, implode(',', $_POST['business_category']));
    $services_offered = mysqli_real_escape_string($conn, implode(',', $_POST['services_offered']));
    $brands_carried = mysqli_real_escape_string($conn, implode(',', $_POST['brands_carried']));
    $phone = mysqli_real_escape_string($conn, implode(',', $_POST['phone']));

    // Input validation
    $errors = [];
    
    // Validate required fields
    $required_fields = ['business_name', 'website', 'short_description', 'long_description', 'mobile', 'country', 'address', 'city', 'state', 'zip', 'time_zone', 'booking_link'];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
        }
    }

    // Validate the phone numbers (optional check for format, example for mobile number)
    if (!empty($_POST['mobile']) && !preg_match('/^\+?\d{10,15}$/', $_POST['mobile'])) {
        $errors[] = "Mobile number is not valid.";
    }

  

    // If errors exist, display them and stop processing
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        exit;
    }

  

    // Insert data into the database
    $query = "INSERT INTO clients 
              (business_name, website, short_description, long_description, phone, mobile, fax, toll_free, country, address, city, state, zip, time_zone, map, booking_link, business_category, services_offered, brands_carried)
              VALUES ('$business_name', '$website', '$short_description', '$long_description', '$phone', '$mobile', '$fax', '$toll_free', '$country', '$address', '$city', '$state', '$zip', '$time_zone', '$map', '$booking_link', '$business_category', '$services_offered', '$brands_carried')";

    echo "$query";
    // if (mysqli_query($conn, $query)) {
    //     echo "Data has been successfully saved.";
    //     echo "$query";
    //     // header('location:Clients.php');
    // } else {
    //     echo "Error: " . mysqli_error($conn);
    // }
}

// Close database connection
mysqli_close($conn);
?>
