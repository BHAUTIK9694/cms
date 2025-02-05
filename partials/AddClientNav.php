<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #F1F1EC;
        }

        .tabs .back button {
            background-color: #007474;
            color: white;
            /* padding: 10px 10px; */
            width: 80px;
            font-size: 12px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
            margin-left: 50px;
        }

        .tabs .back {
            grid-column: span 2;
            text-align: center;
        }

        .tabs.back button:hover {
            background-color: #007474c3;
        }
    </style>
</head>

<body>
<?php
$name = isset($_GET['tab']) ? $_GET['tab'] : 'PrimaryInfo'; // Default to 'PrimaryInfo' if no tab is specified
?>

<div class="tabs">
    <form action="AddClient.php?tab=PrimaryInfo" method="post">
        <button class=<?php echo ($name === 'PrimaryInfo') ? 'active' : ''; ?>>Primary Info</button>
    </form>

    <form action="Hours.php?tab=Hours" method="post">
        <button class=<?php echo ($name === 'Hours') ? 'active' : ''; ?>>Hours</button>
    </form>

    <form action="Social.php?tab=Social" method="post">
        <button class=<?php echo ($name === 'Social') ? 'active' : ''; ?>>Social</button>
    </form>

    <form action="Hosting.php?tab=Hosting" method="post">
        <button class=<?php echo ($name === 'Hosting') ? 'active' : ''; ?>>Hosting & Domain</button>
    </form>

    <form action="Domain.php?tab=Domain" method="post">
        <button class=<?php echo ($name === 'Domain') ? 'active' : ''; ?>> Subscription</button>
    </form>

    <form action="Domain.php?tab=Domain" method="post">
        <button class=<?php echo ($name === 'Domain') ? 'active' : ''; ?>> Images</button>
    </form>

    <form action="Domain.php?tab=Domain" method="post">
        <button class=<?php echo ($name === 'Domain') ? 'active' : ''; ?>> Documents</button>
    </form>

    <form class="back" action="Clients.php">
        <button><i class="fas fa-arrow-left"></i></button>
    </form>

    
</div>

<div>
    <?php
    if ($name === 'PrimaryInfo') {
        echo "Primary Info Content"; // Display primary info form/content here
    } elseif ($name === 'Hours') {
        echo "Hours Content"; // Display hours form/content here
    } elseif ($name === 'Social') {
        echo "Social Content"; // Display social form/content here
    } elseif ($name === 'Hosting') {
        echo "Hosting Content"; // Display hosting form/content here
    } elseif ($name === 'Domain') {
        echo "Subscription"; // Display domain form/content here
    }
    ?>
</div>

</body>

</html>