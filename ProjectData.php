<?php
// Set the content type to JSON
header('Content-Type: application/json');



// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $project_name = isset($_POST['project_name']) ? $_POST['project_name'] : null;
    $client_id = isset($_POST['client_id']) ? $_POST['client_id'] : null;
    $texteditor = isset($_POST['texteditor']) ? $_POST['texteditor'] : null;
    $project_tags = isset($_POST['project_tags']) ? $_POST['project_tags'] : null;
    $status = isset($_POST['status']) ? $_POST['status'] : null;
    $team_member = isset($_POST['team_member']) ? $_POST['team_member'] : null;
    $sales_person = isset($_POST['sales_person']) ? $_POST['sales_person'] : null;
    $manager = isset($_POST['manager']) ? $_POST['manager'] : null;
    $due_date = isset($_POST['due_date']) ? $_POST['due_date'] : null;
    $project_due_days = isset($_POST['project_due_days']) ? $_POST['project_due_days'] : null;
    $project_recurrence = isset($_POST['project_recurrence']) ? $_POST['project_recurrence'] : null;

    // Database operations (using PDO or mysqli)
    include 'partials/sql-connction.php'; // Include your database connection

    try {
        $stmt = $conn->prepare("INSERT INTO project (project_name, client_id, project_description, tags, status, team_member, sales_person, manager, due_date, project_due_days, project_recurrence) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisssssssis", $project_name, $client_id, $texteditor, $project_tags, $status, $team_member, $sales_person, $manager, $due_date, $project_due_days, $project_recurrence);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Project created successfully.";
        } else {
            echo "Failed to create project.";
        }

        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        echo "Database error: " . $e->getMessage();
    }

} else {
    echo "Invalid request.";
}

// // Get the JSON data from the request body
// $json = file_get_contents('php://input');
// $data = json_decode($json, true);

// // Check if the data was received and decoded successfully
// if ($data === null) {
//     echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
//     exit;
// }

// // Access the data
// $client_id = isset($data['client_id']) ? $data['client_id'] : '';
// $due_date = isset($data['due_date']) ? $data['due_date'] : '';
// $manager = isset($data['manager']) ? $data['manager'] : '';
// $project_description = isset($data['project_description']) ? $data['project_description'] : '';
// $project_due_days = isset($data['project_due_days']) ? $data['project_due_days'] : '';
// $project_name = isset($data['project_name']) ? $data['project_name'] : '';
// $project_tags = isset($data['project_tags']) ? $data['project_tags'] : '';
// $sales_person = isset($data['sales_person']) ? $data['sales_person'] : '';
// $status = isset($data['status']) ? $data['status'] : '';
// $team_member = isset($data['team_member']) ? $data['team_member'] : '';
// $project_recurrence = isset($data['project_recurrence']) ? $data['project_recurrence'] : '';

// // Include the database connection file
// include "partials/sql-connction.php";

// try {
//     // Example: Insert data into a database table (adjust as needed)
//     $stmt = $conn->prepare("INSERT INTO project (project_name, client_id, tags, `status`, team_member, sales_person, manager, due_date, project_due_days, project_recurrence) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

//     // Bind parameters
//     $stmt->bind_param("sissssssss", $project_name,$client_id, $project_tags, $status, $team_member, $sales_person, $manager, $due_date, $project_due_days, $project_recurrence);

//     // Execute the statement
//     $stmt->execute();

//     // Check if the insertion was successful
//     if ($stmt->affected_rows > 0) {
//         echo json_encode(['status' => 'success', 'message' => 'Project created successfully']);
//     } else {
//         echo json_encode(['status' => 'error', 'message' => 'Failed to create project']);
//     }

//     $stmt->close();
//     $conn->close();

// } catch (Exception $e) {
//     echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
// }






