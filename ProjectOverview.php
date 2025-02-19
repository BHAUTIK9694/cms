<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Layout</title>

    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="public/css/input.css">
    <link rel="stylesheet" href="public/css/services.css">
    <link rel="stylesheet" href="public/css/tabs.css">
    <link rel="stylesheet" href="public/css/Task.css">
    <link rel="stylesheet" href="public/css/ProjectOverview.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <?php
    include 'partials/navbar.php';
    // include 'partials/AddProjectNav.php';
    include "partials/sql-connction.php";  // Ensure this is your correct database connection
    
    // Get the project ID from the URL (ensure it's an integer)
    $project_id = isset($_GET['Id']) ? (int) $_GET['Id'] : 0;

    // Check if a valid project ID is provided
    if ($project_id > 0) {
        // Prepare a SQL query to fetch project details from the database
        $stmt_project = $conn->prepare("SELECT * FROM project WHERE id = ?");
        $stmt_project->bind_param("i", $project_id);
        $stmt_project->execute();
        $result_project = $stmt_project->get_result();

        if ($result_project->num_rows > 0) {
            $rowdata = $result_project->fetch_assoc();  // Fetch the project data
        } else {
            echo "Project not found!";
            exit();
        }
    } else {
        echo "Project ID not found!";
        exit();
    }
    ?>
    <div>
        <ul class="tabs">
            <li class="tab active" data-tab="tab1">OverView</li>
            <li class="tab" data-tab="tab2">Document</li>
            <li class="tab" data-tab="tab3">Task</li>
            <li class="tab" data-tab="tab4">Team</li>
            <li class="tab" data-tab="tab5">Manage</li>
        </ul>

        <div class="tab-content">
            <div id="tab1" class="tab-pane active">
                <?php include 'Projectinfo.php' ?>
            </div>
            <div id="tab2" class="tab-pane">
                <?php include 'Document.php' ?>
            </div>
            <div id="tab3" class="tab-pane">
                <?php include 'Task.php' ?>
            </div>
            <div id="tab4" class="tab-pane">
                <?php include 'Team.php' ?>
            </div>
            <div id="tab5" class="tab-pane">
                <?php include 'Manage.php' ?>
            </div>
        </div>

    </div>


    <script src="public/js/tabs.js"></script>
    <script>
        document.getElementById("uploadForm").addEventListener("submit", function (event) {
            event.preventDefault();
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            var formData = new FormData();
            formData.append("file", document.getElementById("fileInput").files[0]);
            formData.append("Id", urlParams.get('Id'));
            console.log(urlParams.get('Id'));

            fetch("Document.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.text())
                .then(data => {

                })
                .catch(error => console.error("Error:", error));
        });
    </script>

</body>

</html>