<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Management</title>
    <link rel="shortcut icon" href="./public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #F1F1EC;
        }

        .add-client {
            display: flex;
            justify-content: end;
        }

        .add-client-btn {
            background-color: #007474;
            color: white;
            padding: 5px 10px;
            font-size: 20px;
            margin-top: 20px;
            margin-right: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .add-client-btn:hover {
            background-color: rgb(0, 95, 11);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .client-table {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

        }

        .client-table th,
        .client-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .client-table th {
            background-color: #f2f2f2;
            font-weight: bold;
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
            background-color: #b2d8b2;
            color: #333;
        }

        .filter-btn:hover {
            background-color: rgb(64, 173, 64);
        }

        .add-client-btn {
            background-color: #5cb85c;
            color: white;
        }


        .popup-form {
            display: none;
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

        .popup-form button {
            background-color: #007474;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .popup-form button:hover {
            background-color: #005f5f;
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

    <!-- <div class="client-table">
        <h1>This is Client Page</h1>
        <table border="2">
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Age</td>
                    <td>Mobile</td>
                </tr>
            </thead>
        </table>
    </div> -->

    <!-- New Table -->
    <div class="client-table">
        <table border="4">
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Client ID</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Date Added</th>
                    <th>Sales Person</th>
                    <th>Manager</th>
                    <th>Tag</th>
                    <th>Team Members</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $clients = [
                    ["John Doe", "001", "123-456-7890", "123 Street",   "Active", "2025-01-01",   "Alice", "Bob",       "VIP", "Team A"],
                    ["John Doe", "001", "123-456-7890", "123 Street",   "Active", "2025-01-01",   "Alice", "Bob",       "VIP", "Team A"],
                    ["John Doe", "001", "123-456-7890", "123 Street",   "Active", "2025-01-01",   "Alice", "Bob",       "VIP", "Team A"],
                    ["John Doe", "001", "123-456-7890", "123 Street",   "Active", "2025-01-01",   "Alice", "Bob",       "VIP", "Team A"],
                    ["John Doe", "001", "123-456-7890", "123 Street",   "Active", "2025-01-01",   "Alice", "Bob",       "VIP", "Team A"],
                    ["John Doe", "001", "123-456-7890", "123 Street",   "Active", "2025-01-01",   "Alice", "Bob",       "VIP", "Team A"]
                ];

                foreach ($clients as $client) {
                    echo "<tr>";
                    foreach ($client as $data) {
                        echo "<td>$data</td>";
                    }
                    echo "<td><a href='AddClient.php'><i class=\"fas fa-user-edit\"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp; <a><i class=\"fas fa-trash-alt\"></i></a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
            <tbody>
                <?php
                include "partials/sql-connction.php";

                $query = "SELECT * FROM clients";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($client = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><a href='ClientOverview.php?Id=" . $client['Id'] . "'>" . (!empty($client['business_name']) ? $client['business_name'] : '--') . "</a></td>";
                        echo "<td>" . (!empty($client['Id']) ? $client['Id'] : '--') . "</td>";
                        echo "<td>" . (!empty($client['phone']) ? $client['phone'] : '--') . "</td>";
                        echo "<td>" . (!empty($client['address']) ? $client['address'] : '--') . "</td>";
                        echo "<td>" . (!empty($client['status']) ? $client['status'] : '--') . "</td>";
                        echo "<td>" . (!empty($client['date_added']) ? $client['date_added'] : '--') . "</td>";
                        echo "<td>" . (!empty($client['sales_person']) ? $client['sales_person'] : '--') . "</td>";
                        echo "<td>" . (!empty($client['manager']) ? $client['manager'] : '--') . "</td>";
                        echo "<td>" . (!empty($client['tag']) ? $client['tag'] : '--') . "</td>";
                        echo "<td>" . (!empty($client['team_members']) ? $client['team_members'] : '--') . "</td>";
                        echo "<td>
                    <a href='AddClient.php?Id=" . $client['Id'] . "'><i class='fas fa-user-edit'></i></a>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a href='DeleteClients.php?Id=" . $client['Id'] . "' onclick=\"return confirm('Are you sure you want to delete this client?');\">
                        <i class='fas fa-trash-alt'></i>
                    </a>
                  </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No clients found</td></tr>";
                }

                mysqli_close($conn);
                ?>

            </tbody>
        </table>
    </div>

    <!-- Popup Form -->
    <div class="popup-overlay" onclick="closePopup()"></div>
    <div class="popup-form">
        <h2>Add Client</h2>
        <form action="ClientData.php" method="POST">
            <input type="text" name="client_name" placeholder="Client Name" required>
            <input type="text" name="business_name" placeholder="Business Name" required>
            <input type="url" name="website" placeholder="Website URL">
            <button type="submit">Save</button>
            <button type="button" onclick="closePopup()">Cancel</button>
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