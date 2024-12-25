<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="./public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="public/caa/AddClient.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        body {
            background-color: #F1F1EC;
        }

        .add-client{
            display: flex;
            justify-content: end;
        }

        .add-client-btn {
            background-color: #007474;
            color: white;
            padding: 5px 10px;
            font-size: 20px;
            /* font-weight: bold; */
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
    </style>
</head>

<body>
    <?php include 'partials/navbar.php'; ?>

    <form action="AddClient.php">
        <div class="add-client">
            <input type="submit" value="Add Client" class="add-client-btn" >
        </div>

        <h1>This is Client Page</h1>
        <table border="2">
            <thead>
                <td>name</td>
                <td>age</td>
                <td>mobail</td>
            </thead>
        </table>
    </form>

    <?php 
        include "partials/sql-connction.php";

        
    ?>


</body>

</html>