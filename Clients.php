<?php
include "./partials/sql-connction.php";

// get all clients data from client_primaryinfo table to show in table view
try {
    $sql = "
        SELECT 
            client_id,
            client_name,  
            business_name,
            website, 
            state,
            country,
            time_zone,  
            business_category 
        FROM client_primaryinfo; 
    ";

    $result = $conn->query($sql);

    if ($result) {
        $results = [];
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        $result->free_result();
        $clientData = $results;
    } else {
        echo "Error retrieving client data: " . $conn->error;
    }

} catch (Exception $e) {
    echo "Error retrieving client data: " . $e->getMessage();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Management</title>
    <link rel="shortcut icon" href="./public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="public/css/input.css">
    <!-- <link rel="stylesheet" href="public/css/project.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #F1F1EC;
        }

        .add-client {
            width: 90%;
            display: flex;
            justify-content: end;
            align-items: center;
            text-align: center;
            margin: 20px 70px;
        }

        .add-client-btn {
            width: 5rem;
            padding: 6px 3px;
            border-radius: 6px;
            font-size: large;
            background: #007474;
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .add-client-btn:hover {
            background-color: #007474c3;
        }

        .table-container {
            width: 97%;
            overflow-x: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: white;
        }

        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007474;
        }

        .search-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .search-bar input {
            flex: 1;
            min-width: 200px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .search-bar button {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        .filter-btn {
            width: 5rem;
            padding: 6px 3px;
            border-radius: 6px;
            font-size: large;
            background: #007474;
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .filter-btn:hover {
            background-color: #007474c3;
        }


        .popup-form {
            display: none;
            width: 30%;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            z-index: 1000;
        }

        .popup-form input[type="text"],
        .popup-form input[type="url"] {
            width: 96%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .popup-form .popup-form-btn-oklij78 {
            display: flex;
            justify-content: end;
            align-items: center;
            gap: 1rem;
        }

        .popup-form .save-btn-902wer {
            width: 5rem;
            background-color: #007474;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        .popup-form .cancel-btn-980plok {
            width: 6rem;
            font-weight: bold;
            background-color: white;
            color: #007474;
            padding: 8px 12px;
            border: 1 px solid #007474;
            cursor: pointer;
            margin-top: 10px;
        }

        .popup-form .save-btn-902wer:hover {
            background-color: #005f5f;
        }

        .popup-form .cancel-btn-980plok:hover {
            background-color: #f1f1ec;
        }

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>

<body>
    <?php include 'partials/navbar.php'; ?>
    <div class="search-bar">
        <form action="search_results.php" method="POST">
            <input type="text" name="search_bar" placeholder="Search Bar">
            <input type="text" name="company_name" placeholder="Company Name">
            <input type="date" name="created_date" placeholder="Created Date">
            <input type="text" name="sales_person" placeholder="Sales Person">
            <input type="text" name="lifecycle_stage" placeholder="Lifecycle Stage">
            <button type="submit" class="filter-btn">Filter</button>
        </form>
    </div>
    <div class="add-client">
        <button class="add-client-btn" onclick="openPopup(event)">Add Client</button>
    </div>

    <!-- New Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Business Name</th>
                    <th>Business Category</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Website</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // include 'core/clientFunctions.php';
                // $clientData = getClientDataForTable();
                // echo "<pre>";
                // print_r($clientData);
                // echo "</pre>";
                
                if ($clientData !== false) { // Check if the query was successful
                    // Display data in a table:
                    foreach ($clientData as $row) {
                        echo "<tr>";
                        echo "<td><a href='ClientOverview.php?Id=" . $row['client_id'] . "'>" . $row['client_name'] . "</td>";
                        echo "<td>" . $row['business_name'] . "</td>";
                        echo "<td>" . $row['business_category'] . "</td>";
                        echo "<td>" . $row['state'] . "</td>";
                        echo "<td>" . $row['country'] . "</td>";
                        echo "<td>" . $row['website'] . "</td>";
                        echo "<td>
                    <a href='AddClient.php?Id=" . $row['client_id'] . "'><i class='fas fa-user-edit'></i></a>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href='DeleteClients.php?Id=" . $row['client_id'] . "' onclick=\"return confirm('Are you sure you want to delete this client?');\">
                        <i class='fas fa-trash-alt'></i>
                    </a>
                  </td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No client data found or error occurred.";
                }


                ?>

            </tbody>
        </table>
    </div>

    <!-- Popup Form -->
    <div class="popup-overlay" onclick="closePopup()"></div>
    <div class="popup-form">
        <h2>Add Client</h2>
        <form action="ClientData.php" method="POST">
            <div class="form-input">
                <input type="text" name="client_name" placeholder="Client Name" required>
                <label for="client_name">Client Name</label>
            </div>

            <div class="form-input">
                <input type="text" name="business_name" placeholder="Business Name" required>
                <label for="business_name">Business Name</label>
            </div>
            <div class="form-input">
                <input type="url" name="website" placeholder="Website URL">
                <label for="website">Website URL</label>
            </div>

            <div class="popup-form-btn-oklij78">
                <button type="button" class="cancel-btn-980plok" onclick="closePopup()">Cancel</button>
                <button type="submit" class="save-btn-902wer">Save</button>

            </div>
        </form>
    </div>

    <script>
        function openPopup(event) {
            event.preventDefault();
            document.querySelector('.popup-overlay').style.display = 'block';
            document.querySelector('.popup-form').style.display = 'block';
        }

        function closePopup() {
            document.querySelector('.popup-overlay').style.display = 'none';
            document.querySelector('.popup-form').style.display = 'none';
        }
    </script>

    <?php
    include "partials/sql-connction.php";
    ?>
</body>

</html>

<!-- then if you click save button so add data in clients table  write php script -->
<!-- //Billing Frequency,Last Payment Date,Next Billing Date,Total Amount Due,Payment Method, -->