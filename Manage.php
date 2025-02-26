<?php
// Adjust this path if necessary

include "partials/sql-connction.php";  // Ensure this is your correct database connection
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['date_created'])) {
    echo "abcd";
    $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
    $project_id = mysqli_real_escape_string($conn, $_POST['id']);
    $client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $date_created = mysqli_real_escape_string($conn, $_POST['date_created']);
    $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $billable_type = mysqli_real_escape_string($conn, $_POST['billable_type']);
    $project_price = mysqli_real_escape_string($conn, $_POST['project_price']);
    $budget_type = mysqli_real_escape_string($conn, $_POST['budget_type']);
    $budget = mysqli_real_escape_string($conn, $_POST['budget']);

    // SQL query to update the project data
    $update_query = "UPDATE project SET 
                        project_name = '$project_name', 
                         
                        client_name = '$client_name', 
                        date_created = '$date_created', 
                        due_date = '$due_date', 
                        `status` = '$status', 
                        billable_type = '$billable_type', 
                        project_price = '$project_price', 
                        budget_type = '$budget_type', 
                        budget = '$budget' 
                    WHERE id = $project_id";

    // Execute the update query
    if (mysqli_query($conn, $update_query)) {
        // Redirect to reload the page and show updated data
        header("Location: " . $_SERVER['HTTP_REFERER']);

        exit();
    } else {
        echo "<script>alert('Error updating project: " . mysqli_error($conn) . "');</script>";
    }
}
// Get the project ID from the URL query parameter
$id = isset($_GET['Id']) ? $_GET['Id'] : 1;  // Default to ID 1 if not provided

// Fetch the project data based on the ID
$query = "SELECT * FROM project WHERE id = $id";
$result = mysqli_query($conn, $query);

// Check if the project exists
if (mysqli_num_rows($result) > 0) {
    $project = mysqli_fetch_assoc($result);
} else {
    // If no project is found, display a message
    echo "<script>alert('No project found for this ID.');</script>";
    $project = [
        'project_name' => '',
        'project_id' => '',
        'client_name' => '',
        'date_created' => '',
        'due_date' => '',
        'status' => '',
        'billable_type' => '',
        'project_price' => '',
        'budget_type' => '',
        'budget' => ''
    ];
}

// Handle form submission for updating the project

?>


<head>
    <style>
        /* Global Styles */
        /* body {
            background-color: #f4f7fc;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        } */

        /* Container Styling */
        .manage-container {
            max-width: 700px;
            background: #ffffff;
            padding: 30px;
            margin: 50px auto;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        /* Hover effect for container */
        .manage-container:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
        }

        /* Form Labels */
        .form-label {
            font-weight: 600;
            color: #333;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }

        .form-label.required::after {
            content: " *";
            color: red;
            font-weight: bold;
        }

        /* Unified Input Fields, Select Boxes, and Textareas */
        .form-control,
        .form-select {
            width: 100%;
            padding: 12px 15px;
            /* Uniform padding for all elements */
            font-size: 14px;
            border-radius: 8px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
            margin-bottom: 18px;
            box-sizing: border-box;
            /* Ensures padding doesn't affect total width */
            height: 45px;
            /* Set a consistent height */
        }

        /* Input with Icon */
        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            top: 37%;
            left: 12px;
            transform: translateY(-50%);
            color: #007474;
        }

        .input-with-icon input {
            padding-left: 35px;
            /* Add space for the icon */
        }

        /* Focus effect on inputs and selects */
        .form-control:focus,
        .form-select:focus {
            border-color: #007474;
            background-color: #fff;
            box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.2);
            outline: none;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #007474;
            color: #fff;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
        }

        /* Hover effect on button */
        .btn-primary:hover {
            background-color: #005f5f;
            transform: translateY(-3px);
        }

        /* Button Disabled State */
        .btn-primary:disabled {
            background-color: #c7d3d3;
            cursor: not-allowed;
        }

        /* Error Message Styling */
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: -12px;
            margin-bottom: 18px;
        }

        /* Form Spacing */
        .mb-3 {
            margin-bottom: 25px;
        }

        /* Input Field Padding */
        .form-control,
        .form-select {
            padding-left: 16px;
        }

        /* Input Field and Select Box Placeholder */
        ::placeholder {
            color: #888;
            opacity: 1;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .manage-container {
                max-width: 90%;
                padding: 20px;
            }

            .btn-primary {
                font-size: 14px;
                padding: 12px;
            }
        }
    </style>
</head>

<!-- Add the Font Awesome link in the <head> section -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="container mt-5">
    <form method="POST" action="Manage.php">
        <div class="mb-3">
            <label class="form-label">Project Name: </label>
            <input type="text" name="project_name" class="form-control" required value="<?php echo htmlspecialchars($project['project_name']); ?>">
        </div>
        <div class="mb-3">
            <input type="hidden" name="id" class="form-control" required value="<?php echo htmlspecialchars($project['id']); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Client Name:</label>
            <input type="text" name="client_name" class="form-control" required value="<?php echo htmlspecialchars($project['client_name']); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Start Date:</label>
            <div class="input-with-icon">
                <i class="fas fa-calendar-alt"></i>
                <input type="date" name="date_created" class="form-control" value="<?php echo htmlspecialchars($project['date_created']); ?>">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">End Date:</label>
            <div class="input-with-icon">
                <i class="fas fa-calendar-alt"></i>
                <input type="date" name="due_date" class="form-control" value="<?php echo htmlspecialchars($project['due_date']); ?>">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Status:</label>
            <select name="status" class="form-select">
                <option selected><?php echo htmlspecialchars($project['status']); ?></option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Billable Type:</label>
            <select name="billable_type" class="form-select">
                <option value="Hourly" <?php echo (($project['billable_type']) == "Hourly" ? "selected" : ""); ?>>Hourly</option>
                <option value="Fixed" <?php echo (($project['billable_type']) == "Fixed" ? "selected" : ""); ?>>Fixed</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Billable Rates:</label>
            <select name="billable_rates" class="form-select">
                <option selected><?php echo htmlspecialchars($project['billable_rate']); ?></option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Project Price:</label>
            <div class="input-with-icon">
                <i class="fas fa-dollar-sign"></i>
                <input type="number" name="project_price" class="form-control" value="<?php echo htmlspecialchars($project['project_price']); ?>">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Budget Type:</label>
            <select name="budget_type" class="form-select">
                <option value="Billable" <?php echo (($project['budget_type']) == "Billable" ? "selected" : ""); ?>>Billable</option>
                <option value="Non-Billable" <?php echo (($project['budget_type']) == "Non-Billable" ? "selected" : ""); ?>>Non-Billable</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Budget:</label>
            <div class="input-with-icon">
                <i class="fas fa-dollar-sign"></i>
                <input type="number" name="budget" class="form-control" value="<?php echo htmlspecialchars($project['budget']); ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</form>
</div>