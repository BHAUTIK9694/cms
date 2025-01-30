<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription</title>
    <link rel="stylesheet" href="public/css/AddClient.css">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #F1F1EC;
        }

        .subscription-table {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

        }

        .subscription-table th,
        .subscription-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .subscription-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .subscription-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <?php
    include 'partials/navbar.php';
    include 'partials/AddClientNav.php';
    ?>
    <div class="subscription-table">
        <table border="4">
            <thead>
                <tr>
                    <th>Subscription</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $subscriptions = [
                    ["Premium Plan", "Active", "2024-01-01", "2025-01-01", "$99.99"],
                    ["Basic Plan", "Expired", "2023-01-01", "2024-01-01", "$49.99"],
                    ["Gold Plan", "Active", "2023-06-01", "2024-06-01", "$79.99"],
                    ["Silver Plan", "Cancelled", "2023-03-15", "2023-09-15", "$59.99"],
                    ["Family Plan", "Active", "2024-02-10", "2025-02-10", "$119.99"],
                ];

                foreach ($subscriptions as $sub) {
                    echo "<tr>
                            <td>{$sub[0]}</td>
                            <td>{$sub[1]}</td>
                            <td>{$sub[2]}</td>
                            <td>{$sub[3]}</td>
                            <td>{$sub[4]}</td>
                            <td> &nbsp; &nbsp;&nbsp;<a href='#'><i class='fas fa-trash-alt'></i></a></td>
                          </tr>";
                }

                ?>
        </table>
    </div>
</body>

</html>