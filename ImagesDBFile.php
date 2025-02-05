<?php
include "partials/sql-connction.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $uploadDir = "uploads/";

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }


    $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];


    $imageTypes = ['logo', 'gallery', 'other1', 'other2'];
    $uploadedImages = [];

    foreach ($imageTypes as $type) {
        if (isset($_FILES[$type]) && $_FILES[$type]['error'] === 0) {
            $fileName = basename($_FILES[$type]["name"]);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (in_array($fileExt, $allowedFormats)) {
                $targetFilePath = $uploadDir . time() . "_" . $fileName;

                if (move_uploaded_file($_FILES[$type]["tmp_name"], $targetFilePath)) {
                    $uploadedImages[$type] = $targetFilePath;
                } else {
                    echo "<p>Failed to upload $type image.</p>";
                }
            } else {
                echo "<p>Invalid format for $type image. Allowed formats: jpg, jpeg, png, gif.</p>";
            }
        }
    }


    $logo = isset($uploadedImages['logo']) ? mysqli_real_escape_string($conn, $uploadedImages['logo']) : '';
    $gallery = isset($uploadedImages['gallery']) ? mysqli_real_escape_string($conn, $uploadedImages['gallery']) : '';
    $other1 = isset($uploadedImages['other1']) ? mysqli_real_escape_string($conn, $uploadedImages['other1']) : '';
    $other2 = isset($uploadedImages['other2']) ? mysqli_real_escape_string($conn, $uploadedImages['other2']) : '';


    $query = "INSERT INTO images (logo, gallery, other1, other2)
              VALUES ('$logo', '$gallery', '$other1', '$other2')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Images uploaded successfully!'); window.location.href='upload_images.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }
}

// Close database connection
mysqli_close($conn);
