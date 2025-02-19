<?php
session_start();

include 'partials/sql-connction.php';

// Initialize error messages array
$errors = [];

$clientId = isset($_SESSION['clientId']) ? $_SESSION['clientId'] : '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize the input values
    $facebook = isset($_POST['facebook']) ? trim($_POST['facebook']) : '';
    $twitter = isset($_POST['twitter']) ? trim($_POST['twitter']) : '';
    $instagram = isset($_POST['instagram']) ? trim($_POST['instagram']) : '';
    $linkedin = isset($_POST['linkedin']) ? trim($_POST['linkedin']) : '';
    $youtube = isset($_POST['youtube']) ? trim($_POST['youtube']) : '';
    $custom_name = isset($_POST['custom_name']) ? trim($_POST['custom_name']) : '';
    $custom_link = isset($_POST['custom_link']) ? trim($_POST['custom_link']) : '';

    // Validation: Ensure all required fields are filled
    if (empty($facebook)) {
        $errors['facebook'] = "Facebook URL is required.";
    }
    if (empty($twitter)) {
        $errors['twitter'] = "Twitter URL is required.";
    }
    if (empty($instagram)) {
        $errors['instagram'] = "Instagram URL is required.";
    }
    if (empty($linkedin)) {
        $errors['linkedin'] = "LinkedIn URL is required.";
    }
    if (empty($youtube)) {
        $errors['youtube'] = "YouTube URL is required.";
    }

    if (empty($errors)) {
        // Check if there's already a social media record for this client
        $queryCheck = "SELECT * FROM clients WHERE Id = {$clientId}";
        $resultCheck = mysqli_query($conn, $queryCheck);

        if (mysqli_num_rows($resultCheck) > 0) {
            // Update the existing record
            $query = "UPDATE clients 
                    SET facebook = '{$facebook}', twitter = '{$twitter}', instagram = '{$instagram}', linkedin = '{$linkedin}', youtube = '{$youtube}', 
                        custom_name = '{$custom_name}', custom_link = '{$custom_link}' 
                    WHERE Id = {$clientId}";
        } else {
            // Insert new record
            $query = "INSERT INTO clients (Id, facebook, twitter, instagram, linkedin, youtube, custom_name, custom_link) 
                    VALUES ({$clientId}, '{$facebook}', '{$twitter}', '{$instagram}', '{$linkedin}', '{$youtube}', '{$custom_name}', '{$custom_link}')";
        }

        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Social media links have been successfully submitted!";
            header("Location: Social.php"); // Redirect to success page
            exit();
        } else {
            $errors['db'] = "Error: " . mysqli_error($conn);
        }
    }
}

// Close the database connection
$conn->close();
