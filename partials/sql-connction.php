<?php


    if ($_SERVER['HTTP_HOST'] === 'cms.celaenotechnology.com') {
        $servername = "localhost";
        $username = "u603122711_bhautikkotadiy";
        $password = "@Hii.2412";
        $dbname = "u603122711_cms";

    } else {
    
        $servername = "localhost"; 
        $username = "root";      
        $password = "";          
        $dbname = "client_manager"; 

    }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }