<?php
// Start the session to handle messages
session_start();

include 'partials/sql-connction.php';

// Initialize error messages array
$errors = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize the input values
    $facebook = isset($_POST['facebook']) ? trim($_POST['facebook']) : '';
    $twitter = isset($_POST['twitter']) ? trim($_POST['twitter']) : '';
    $instagram = isset($_POST['instagram']) ? trim($_POST['instagram']) : '';
    $linkedin = isset($_POST['linkedin']) ? trim($_POST['linkedin']) : '';
    $youtube = isset($_POST['youtube']) ? trim($_POST['youtube']) : '';

    // Validation: Ensure all fields are filled
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

   
    if(empty($errors)){
        $query="insert into  clientlink (facebook, twitter, instagram, linkedin, youtube) values ('{$facebook}','{$twitter}','{$linkedin}','{$youtube}','{$instagram}') ";

        if(mysqli_query($conn,$query)){
            $_SESSION['success'] ="Social media links have been successfully submitted!";
            header("Location: Social.php"); // Redirect to success page (create a success.php)
            exit();
        }else{
            $errors['db'] = "Error: ".mysqli_error($conn);
        }
    }
}

// Close the database connection
$conn->close();
?>
