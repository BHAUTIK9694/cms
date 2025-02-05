<?php
session_start();
include "partials/sql-connction.php"; // Database connection

// Ensure the upload directory exists
$uploadDir = 'Images/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Retrieve Client ID
$clientId = isset($_SESSION['clientId']) ? $_SESSION['clientId'] : (isset($_GET['Id']) ? $_GET['Id'] : '');
if ($clientId) {
    $_SESSION['clientId'] = $clientId; // Store in session
} else {
    die("Client ID is missing!");
}

// Function to handle file uploads
function uploadFile($inputName, $uploadDir)
{
    if (!empty($_FILES[$inputName]['name'])) {
        $fileName = time() . "_" . basename($_FILES[$inputName]['name']);
        $targetFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetFilePath)) {
            return $targetFilePath;
        }
    }
    return null;
}

// If form is submitted, process file uploads
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $logoPath = uploadFile('logo', $uploadDir);
    $faviconPath = uploadFile('favicon', $uploadDir);
    $primaryImagePath = uploadFile('primary', $uploadDir);

    // Handle multiple gallery images
    $galleryPaths = [];
    if (!empty($_FILES['gallery']['name'][0])) {
        foreach ($_FILES['gallery']['name'] as $key => $fileName) {
            $fileTmp = $_FILES['gallery']['tmp_name'][$key];
            $newFileName = time() . "_" . $fileName;
            $targetFilePath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmp, $targetFilePath)) {
                $galleryPaths[] = $targetFilePath;
            }
        }
    }
    $galleryPathString = !empty($galleryPaths) ? implode(",", $galleryPaths) : null;

    // Save to database
    $sql = "UPDATE clients SET 
            logo = ?, 
            favicon = ?, 
            primary_image = ?, 
            gallery = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $logoPath, $faviconPath, $primaryImagePath, $galleryPathString, $clientId);

    if ($stmt->execute()) {
        echo "<script>alert('Images uploaded successfully!');</script>";
    } else {
        echo "<script>alert('Database error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
            margin-top: 20px;
        }

        .upload-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%;
        }

        .row {
            display: flex;
            justify-content: space-between;
            width: 100%;
            gap: 20px;
        }

        .upload-card {
            flex: 1;
            /* Ensures all 3 cards take equal space */
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }


        .upload-card input {
            display: block;
            margin: 10px auto;
        }

        /* Fourth Upload Section */
        .upload-card.full-width {
            width: 100%;
        }

        .preview,
        .preview-multiple {
            margin-top: 10px;
            min-height: 150px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            border: 2px dashed #ccc;
            color: #999;
            font-size: 14px;
            padding: 10px;
        }

        .preview-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .file-size-warning {
            font-size: 12px;
            color: red;
            margin-top: 5px;
        }

        .submit-btn {
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            background-color: #007474;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #007474c3;
        }
    </style>
</head>

<body>
    <?php
    include 'partials/navbar.php';
    include 'partials/AddClientNav.php';
    ?>
    <h1><?php echo $clientId; ?></h1>
    <input type="hidden" id="client-id" name="client_id" value="<?php echo $clientId; ?>" required>
    <div class="container">
        <h2>Upload Images</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="upload-section">
                <div class="row">
                    <div class="upload-card">
                        <label>Upload Logo:</label>
                        <input type="file" name="logo" id="logo" accept="image/*">
                        <div class="preview" id="logo-preview">No Image</div>
                    </div>

                    <div class="upload-card">
                        <label>Upload Favicon:</label>
                        <input type="file" name="favicon" id="favicon" accept="image/*">
                        <div class="preview" id="favicon-preview">No Image</div>
                    </div>

                    <div class="upload-card">
                        <label>Upload Primary:</label>
                        <input type="file" name="primary" id="primary" accept="image/*">
                        <div class="preview" id="primary-preview">No Image</div>
                    </div>
                </div>

                <div class="upload-card full-width">
                    <label>Upload Gallery:</label>
                    <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple>
                    <div class="file-size-warning">Max file size: 10MB per image</div>
                    <div class="preview-multiple" id="gallery-preview">No Images</div>
                </div>
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

    <script>
        function previewImage(inputId, previewId, multiple = false, maxSizeMb = null) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            input.addEventListener('change', function() {
                const files = this.files;
                preview.innerHTML = ""; // Clear previous content

                if (files.length > 0) {
                    for (let i = 0; i < files.length; i++) {
                        if (maxSizeMb && files[i].size > maxSizeMb * 1024 * 1024) {
                            alert(`File size must be under ${maxSizeMb}MB!`);
                            this.value = "";
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement("img");
                            img.src = e.target.result;
                            img.alt = "Uploaded Image";
                            img.classList.add("preview-img");

                            if (multiple) {
                                preview.appendChild(img);
                            } else {
                                preview.innerHTML = "";
                                preview.appendChild(img);
                            }
                        };
                        reader.readAsDataURL(files[i]);
                    }
                } else {
                    preview.innerHTML = "No Image";
                }
            });
        }

        // Call function for each upload field
        previewImage("logo", "logo-preview");
        previewImage("favicon", "favicon-preview");
        previewImage("primary", "primary-preview");
        previewImage("gallery", "gallery-preview", true, 10); // Multiple images with 10MB restriction
    </script>
</body>

</html>