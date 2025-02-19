<?php
// Include the database connection file
include "partials/sql-connction.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize inputs
    $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
    $client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $tags = mysqli_real_escape_string($conn, $_POST['tags']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $team_member = mysqli_real_escape_string($conn, $_POST['team_member']);
    $date_created = mysqli_real_escape_string($conn, $_POST['date_created']);
    $sales_person = mysqli_real_escape_string($conn, $_POST['sales_person']);
    $manager = mysqli_real_escape_string($conn, $_POST['manager']);
    $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);
    $project_price = mysqli_real_escape_string($conn, $_POST['project_price']);

    $sql = "INSERT INTO project (project_name, client_name, tags, `status`, team_member, date_created, sales_person, manager, due_date) 
        VALUES ('$project_name', '$client_name', '$tags', '$status', '$team_member', '$date_created', '$sales_person', '$manager', '$due_date')";

}



if (mysqli_query($conn, $sql)) {    
    echo "<script>alert('Project added successfully!'); window.location.href='project.php';</script>";
} else {
    echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.history.back();</script>";


    // Close the database connection
mysqli_close($conn);
}


    
