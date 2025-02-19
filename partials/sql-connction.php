<?php
$servername = "localhost"; // or "127.0.0.1"
$username = "root";        // your MySQL username
$password = "";            // your MySQL password
$dbname = "client_manager"; // your database name
$port = "3306"; // your MySQL server port

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
