<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Management</title>
    <link rel="shortcut icon" href="./public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

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
            background-color: #005f5f;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .client-table {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
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

    <div class="add-client">
        <button class="add-client-btn" onclick="openPopup(event)">Add Client</button>
    </div>

    <div class="client-table">
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
    </div>

    <!-- Popup Form -->
    <div class="popup-overlay" onclick="closePopup()"></div>
    <div class="popup-form">
        <h2>Add Client</h2>
        <form action="ClientData.php" method="POST">
            <input type="text" name="client_name" placeholder="Client Name" required>
            <input type="text" name="business_name" placeholder="Business Name" required>
            <input type="url" name="website" placeholder="Website URL" required>
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