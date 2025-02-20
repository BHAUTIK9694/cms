<?php
include "./partials/sql-connction.php";

// Get client ID from URL (Simulating a logged-in client)
$client_id = isset($_GET['Id']) ? intval($_GET['Id']) : 1;

$upload_dir = "uploads/";

$logo = $favicon = $primary = "";
$gallery = [];

$result = $conn->query("SELECT * FROM client_uploads WHERE client_id = $client_id");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $logo = $row['logo'];
    $favicon = $row['favicon'];
    $primary = $row['primary_image'];
    $gallery = json_decode($row['gallery'], true) ?? [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
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
    <input type="hidden" id="client-id" name="client_id" value="<?php echo $clientId; ?>" required>
    <div class="client-container-outer-674pl">
        <div style="width: 95%;">
            <h2>Upload Images</h2>

            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
                <div class="upload-section">
                    <div class="row">
                        <div class="upload-card">
                            <label>Upload Logo:</label>
                            <input type="file" name="logo" id="logo" accept="image/*">
                            <div class="preview" id="logo-preview">
                                <?php if ($logo)
                                    echo "<img src='$upload_dir$logo' width='100'>";
                                else
                                    echo "No Image"; ?>
                            </div>
                        </div>

                        <div class="upload-card">
                            <label>Upload Favicon:</label>
                            <input type="file" name="favicon" id="favicon" accept="image/*">
                            <div class="preview" id="favicon-preview">
                                <?php if ($favicon)
                                    echo "<img src='$upload_dir$favicon' width='50'>";
                                else
                                    echo "No Image"; ?>
                            </div>
                        </div>

                        <div class="upload-card">
                            <label>Upload Primary:</label>
                            <input type="file" name="primary" id="primary" accept="image/*">
                            <div class="preview" id="primary-preview">
                                <?php if ($primary)
                                    echo "<img src='$upload_dir$primary' width='100'>";
                                else
                                    echo "No Image"; ?>
                            </div>
                        </div>
                    </div>

                    <div class="upload-card full-width">
                        <label>Upload Gallery:</label>
                        <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple>
                        <div class="file-size-warning">Max file size: 10MB per image</div>
                        <div class="preview-multiple" id="gallery-preview">
                            <?php
                            if (!empty($gallery)) {
                                foreach ($gallery as $img) {
                                    echo "<img src='$upload_dir$img' width='100' style='margin-right:10px;'>";
                                }
                            } else {
                                echo "No Images";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Submit</button>
            </form>

        </div>
    </div>

    <script>
        function previewImage(inputId, previewId, multiple = false, maxSizeMb = null) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            input.addEventListener('change', function () {
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
                        reader.onload = function (e) {
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