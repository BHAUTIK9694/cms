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

        

        .client-table th,
        .client-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
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
            background-color: #007474;
            color: #333;
            color: white;
        }

        .filter-btn:hover {
            background-color: #4fa6a4;
        }

        .btn:hover {
        opacity: 0.8;
}

.client-table {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;

    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    display: none; /* Keeps it hidden until needed */
    z-index: 1000;
}

.client-table table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
}

.client-table th, 
.client-table td {
    padding: 10px;
    border: 1px solid #ccc;
}

.client-table th {
    background: #007474;
    color: white;
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
    
    <nav id="navbar">
    <ul id="menu">
        <li>
            <div class="add-client">
                <button class="add-client-btn" onclick="toggleTable('table1')">Booking</button>
            </div>
        </li>
        <li>
            <div class="add-client">
                <button class="add-client-btn" onclick="toggleTable('table2')">Invoice</button>
            </div>
        </li>
        <li>
            <div class="add-client">
                <button class="add-client-btn" onclick="toggleTable('table3')">HRMS</button>
            </div>
        </li>
        <li>
            <div class="add-client">
                <button class="add-client-btn" onclick="toggleTable('table4')">Timesheet</button>
            </div>
        </li>
        <li>
            <div class="add-client">
                <button class="add-client-btn" onclick="toggleTable('table5')">Punctual</button>
            </div>
        </li>
    </ul>
</nav>



<div class="client-table" id="table1" style="display:none;">
    <table border="4">
        <!-- Table content here -->
        <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Package</th>
                    <th>Register Date</th>
                    <th>Total User</th>
                    <th>Total Licence</th>
                    <th>Status</th>
                    
                </tr>
            </thead>

            <tbody>
                <?php
                // Sample static data
                $clients = [
                    ["id" => 1, "company" => "ABC Pvt Ltd", "package" => "Premium", "date" => "2024-01-15", "users" => 10,"Total User"=>"10/1","status" => "Active"],
                    ["id" => 2, "company" => "XYZ Solutions", "package" => "Standard", "date" => "2023-12-20", "users" => 5,"Total User"=>"5/2", "status" => "Inactive"],
                    ["id" => 3, "company" => "Tech Innovations", "package" => "Enterprise", "date" => "2024-02-10", "users" => 20, "Total User"=>"20/2","status" => "Active"],
                ];

                foreach ($clients as $client) {
                    echo "<tr>
                        <td>{$client['id']}</td>
                        <td>{$client['company']}</td>
                        <td>{$client['package']}</td>
                        <td>{$client['date']}</td>
                        <td>{$client['users']}</td>
                        <td>
                       {$client['Total User']}
                        </td>
                        <td>{$client['status']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        
    </table>
</div>

<div class="client-table" id="table2" style="display:none;">
    <table border="4">
        <!-- Table content here -->

        <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Package</th>
                    <th>Register Date</th>
                    <th>Total User</th>
                    <th>Total Licence</th>
                    <th>Status</th>
                    
                </tr>
            </thead>

            <tbody>
                <?php
                // Sample static data
                $clients = [    
                ["id" => 1, "company" => "ABC Pvt Ltd", "package" => "Premium", "date" => "2024-01-15", "users" => 10,"Total User"=>"10/1","status" => "Active"],
                ["id" => 2, "company" => "XYZ Solutions", "package" => "Standard", "date" => "2023-12-20", "users" => 25,"Total User"=>"25/1", "status" => "Inactive"],
                ["id" => 3, "company" => "Tech Innovations", "package" => "Enterprise", "date" => "2024-02-10", "users" => 20, "Total User"=>"20/2","status" => "Active"],
                ];

                foreach ($clients as $client) {
                    echo "<tr>
                        <td>{$client['id']}</td>
                        <td>{$client['company']}</td>
                        <td>{$client['package']}</td>
                        <td>{$client['date']}</td>
                        <td>{$client['users']}</td>
                        <td>
                       {$client['Total User']}
                        </td>
                        <td>{$client['status']}</td>
                    </tr>";
                }
                ?>
            </tbody>
    </table>
</div>

<div class="client-table" id="table3" style="display:none;">
    <table border="4">
        <!-- Table content here -->

        <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Package</th>
                    <th>Register Date</th>
                    <th>Total User</th>
                    <th>Total Licence</th>
                    <th>Status</th>
                    
                </tr>
            </thead>

            <tbody>
                <?php
                // Sample static data
                $clients = [    
                ["id" => 1, "company" => "ABC Pvt Ltd", "package" => "Premium", "date" => "2024-01-15", "users" => 10,"Total User"=>"10/1","status" => "Active"],
                ["id" => 2, "company" => "XYZ Solutions", "package" => "Standard", "date" => "2023-12-20", "users" => 15,"Total User"=>"15/1", "status" => "Inactive"],
                ["id" => 3, "company" => "Tech Innovations", "package" => "Enterprise", "date" => "2024-02-10", "users" => 25, "Total User"=>"25/2","status" => "Active"],
                ];

                foreach ($clients as $client) {
                    echo "<tr>
                        <td>{$client['id']}</td>
                        <td>{$client['company']}</td>
                        <td>{$client['package']}</td>
                        <td>{$client['date']}</td>
                        <td>{$client['users']}</td>
                        <td>
                       {$client['Total User']}
                        </td>
                        <td>{$client['status']}</td>
                    </tr>";
                }
                ?>
            </tbody>
    </table>
</div>

<div class="client-table" id="table4" style="display:none;">
    
    <table border="4">
        <!-- Table content here -->
        <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Package</th>
                    <th>Register Date</th>
                    <th>Total User</th>
                    <th>Total Licence</th>
                    <th>Status</th>
                    
                </tr>
            </thead>

            <tbody>
                <?php
                // Sample static data
                $clients = [    
                ["id" => 1, "company" => "ABC Pvt Ltd", "package" => "Premium", "date" => "2024-01-15", "users" => 15,"Total User"=>"15/1","status" => "Active"],
                ["id" => 2, "company" => "XYZ Solutions", "package" => "Standard", "date" => "2023-12-20", "users" => 25,"Total User"=>"25/1", "status" => "Inactive"],
                ["id" => 3, "company" => "Tech Innovations", "package" => "Enterprise", "date" => "2024-02-10", "users" => 30, "Total User"=>"30/2","status" => "Active"],
                ];

                foreach ($clients as $client) {
                    echo "<tr>
                        <td>{$client['id']}</td>
                        <td>{$client['company']}</td>
                        <td>{$client['package']}</td>
                        <td>{$client['date']}</td>
                        <td>{$client['users']}</td>
                        <td>
                       {$client['Total User']}
                        </td>
                        <td>{$client['status']}</td>
                    </tr>";
                }
                ?>
            </tbody>
    </table>
</div>

<div class="client-table" id="table5" style="display:none;">
    
    <table border="4">
        <!-- Table content here -->
        <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Package</th>
                    <th>Register Date</th>
                    <th>Total User</th>
                    <th>Total Licence</th>
                    <th>Status</th>
                    
                </tr>
            </thead>

            <tbody>
                <?php
                // Sample static data
                $clients = [    
                ["id" => 1, "company" => "ABC Pvt Ltd", "package" => "Premium", "date" => "2024-01-15", "users" => 25,"Total User"=>"25/1","status" => "Active"],
                ["id" => 2, "company" => "XYZ Solutions", "package" => "Standard", "date" => "2023-12-20", "users" => 20,"Total User"=>"20/1", "status" => "Inactive"],
                ["id" => 3, "company" => "Tech Innovations", "package" => "Enterprise", "date" => "2024-02-10", "users" => 15, "Total User"=>"15/2","status" => "Active"],
                ];

                foreach ($clients as $client) {
                    echo "<tr>
                        <td>{$client['id']}</td>
                        <td>{$client['company']}</td>
                        <td>{$client['package']}</td>
                        <td>{$client['date']}</td>
                        <td>{$client['users']}</td>
                        <td>
                       {$client['Total User']}
                        </td>
                        <td>{$client['status']}</td>
                    </tr>";
                }
                ?>
            </tbody>
    </table>
</div>


       
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
        // Function to toggle between tables
function toggleTable(tableId) {
    // Hide all tables
    var tables = document.querySelectorAll('.client-table');
    tables.forEach(function (table) {
        table.style.display = "none";  // Hide all tables
    });

    // Show the clicked table
    var tableToShow = document.getElementById(tableId);
    if (tableToShow) {
        tableToShow.style.display = "block";  // Show the selected table
    }
}

    </script>


</body>

</html>

<!-- then if you click save button so add data in clients table  write php script -->