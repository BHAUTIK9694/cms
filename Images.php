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
            /* Center horizontally */
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
            /* Align with navbar */
            margin-top: 20px;
        }

        .upload-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .upload-card {
            width: 45%;
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

    <div class="container">
        <h2>Upload Images</h2>

        <div class="upload-section">
            <!-- Upload Card 1 -->
            <div class="upload-card">
                <label>Upload Logo:</label>
                <input type="file" id="logo" accept="image/*">
                <div class="preview" id="logo-preview">No Image</div>
            </div>

            <!-- Upload Card 2 (Multiple Gallery Images) -->
            <div class="upload-card">
                <label>Upload Gallery Images:</label>
                <input type="file" id="gallery" accept="image/*" multiple>
                <div class="preview-multiple" id="gallery-preview">No Images</div>
            </div>

            <!-- Upload Card 3 -->
            <div class="upload-card">
                <label>Upload Other Image 1:</label>
                <input type="file" id="other1" accept="image/*">
                <div class="preview" id="other1-preview">No Image</div>
            </div>

            <!-- Upload Card 4 -->
            <div class="upload-card">
                <label>Upload Other Image 2:</label>
                <input type="file" id="other2" accept="image/*">
                <div class="preview" id="other2-preview">No Image</div>
            </div>
        </div>

        <button class="submit-btn">Submit</button>
    </div>

    <script>
        function previewImage(inputId, previewId, multiple = false) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            input.addEventListener('change', function() {
                const files = this.files;
                preview.innerHTML = ""; // Clear previous content

                if (files.length > 0) {
                    for (let i = 0; i < files.length; i++) {
                        if (files[i].size > 10 * 1024 * 1024) { // 10MB limit
                            alert("File size must be under 10MB!");
                            this.value = ""; // Clear the file input
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
                                preview.innerHTML = ""; // Replace previous image
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
        previewImage("gallery", "gallery-preview", true); // Multiple images
        previewImage("other1", "other1-preview");
        previewImage("other2", "other2-preview");
    </script>
</body>

</html>