<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-decoration: underline;
        }

        .image-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .image-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .image-form label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .image-form input {
            width: 96%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .image-form button {
            background-color: #0077ff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .save-btn button {
            background-color: #007474;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .save-btn {
            grid-column: span 2;
            text-align: center;
        }

        .save-btn button:hover {
            background-color: #007474c3;
        }

        .session {
            background-color: #E5E5E5;
            color: #007474;
            padding: 5px;
            border-radius: 7px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    include 'partials/navbar.php';
    include 'partials/AddClientNav.php';
    ?>
    <form action="uploadImages.php" method="POST" enctype="multipart/form-data">
        <div class="container">
            <div class="image-form">
                <h2>Images Upload</h2>
                <form action="UploadImages.php" method="post" enctype="multipart/form-data">
                    <label for="logo">Upload Logo:</label>
                    <input type="file" name="logo" id="logo" accept="image/*">
                    <label for="gallery">Upload Gallery Images:</label>
                    <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple>
                    <label for="other1">Upload Other Image 1:</label>
                    <input type="file" name="other1" id="other1" accept="image/*">
                    <label for="other2">Upload Other Image 2:</label>
                    <input type="file" name="other2" id="other2" accept="image/*">
                    <div class="save-btn">
                        <button type="submit" name="upload">Upload Images</button>
                    </div>
                </form>
            </div>
            <div>
</body>

</html>