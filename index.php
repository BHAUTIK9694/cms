<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="shortcut icon" href="./public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>


    <?php include 'partials/navbar.php'; ?>



    <?php $name = isset($_GET['tab']) ? $_GET['tab'] : null; ?>
    <div class="tabs">
        <form action="index.php?tab=Services" method="post">
            <button class=<?php if ($name === 'Services') {
                echo "active";
            }
            ; ?>>Services</button>
        </form>
        <form action="index.php?tab=Classes" method="post">
            <button class=<?php if ($name === 'Classes') {
                echo "active";
            }
            ; ?>>Classes</button>
        </form>
        <form action="index.php?tab=Consultation" method="post">
            <button class=<?php if ($name === 'Consultation') {
                echo "active";
            }
            ; ?>>Consultation</button>
        </form>
        <form action="index.php?tab=Resources" method="post">
            <button class=<?php if ($name === 'Resources') {
                echo "active";
            }
            ; ?>>Resources</button>
        </form>

    </div>
    <div>
        <?php
        if ($name === 'Services') {
          echo "Service";
        } elseif ($name === 'Classes') {
            echo "Classes";
           
        } elseif ($name === 'Consultation') {
            echo "Consultation";
        }elseif ($name === 'Resources') {
            echo "Resources";
        }
        
        ?>
    <div>
</body>

</html>