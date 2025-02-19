<?php
include "partials/sql-connction.php";  // Ensure this is your correct database connection

$message = ""; // Initialize an empty message variable

// Check if the form was submitted and the file was uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
    $target_dir = "Uploads/";

    $project_id = isset($_POST['Id']) ? (int) $_POST['Id'] : 0;

    // Create the upload directory if it doesn't exist
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create folder if not exists
    }

    // Check if file is uploaded successfully
    $file_name = basename($_FILES["file"]["name"]);
    $file_size = round($_FILES["file"]["size"] / 1024, 2) . " KB"; // Convert size to KB
    $target_file = $target_dir . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Allowed file types
    $allowed_types = ["jpg", "jpeg", "png", "pdf", "doc", "docx", "txt"];
    var_dump($file_name, $file_size, $target_file, $project_id, $uploaded_by);



    // Check file type
    if (!in_array($file_type, $allowed_types)) {
        $message = "Only JPG, PNG, PDF, DOC, DOCX, and TXT files are allowed.";
    }
    // Move the file to the upload folder
    elseif (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $uploaded_by = "User"; // Change to dynamic user if needed

        // Debugging: Check values before insertion
        var_dump($file_name, $file_size, $target_file, $project_id, $uploaded_by);

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO documents (document_name, file_size, file_path, project_id, uploaded_by) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Failed to prepare the statement: " . $conn->error);
        }

        $stmt->bind_param("sssis", $file_name, $file_size, $target_file, $project_id, $uploaded_by);

        if ($stmt->execute()) {
            $message = "File uploaded and saved successfully.";
        } else {
            $message = "Error saving file details in database: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Error uploading file.";
    }
} else {
    // Handle case when no file is selected or there's an error with the file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] !== 0) {
        $message = "File upload error: " . $_FILES['file']['error'];
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        $message = "No file selected or file upload error.";
    }
}

// Fetch uploaded files from the database
$proj_id = isset($_GET['Id']) ? (int) $_GET['Id'] : 0;

$stmt = $conn->prepare("SELECT * FROM documents WHERE project_id = ? ORDER BY uploaded_on DESC");
$stmt->bind_param("i", $proj_id);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #007474;
            margin-bottom: 20px;
        }

        .alert {
            padding: 10px;
            margin: 10px 0;
            color: white;
            background-color: #ff4d4d;
            /* Red for errors */
            border-radius: 5px;
            text-align: center;
        }


        form {

            margin-bottom: 20px;
        }

        input[type="file"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            color: #007474;
        }

        button {
            background: #007474;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }



        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background: #007474;
            color: white;
        }

        td a {
            text-decoration: none;
            color: #007474;
            font-weight: bold;
        }

        td a:hover {
            text-decoration: underline;
        }


        .btn-upload {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
        }

        .btn-delete {
            color: red;
        }

        .btn-delete:hover {
            color: darkred;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><i class="fas fa-file-upload"></i> Upload a Document</h2>

        <?php if (!empty($message)): ?>
            <div class="alert"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form id="uploadForm" enctype="multipart/form-data" method="POST" class="mb-4" action="Document.php">
            <div class="input-group">
                <input type="file" name="file" id="fileInput" class="form-control" required>
                <input type="hidden" name="Id" value="<?php echo $proj_id; ?>">
                <button type="submit" class="btn btn-primary"> <i class="fas fa-upload"></i> Upload </button>
            </div>

        </form>


        <table>
            <thead>
                <tr>
                    <th>Document Name</th>
                    <th>Size</th>
                    <th>Attached By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="fileTableBody">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['document_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['file_size']); ?></td>
                            <td><?php echo htmlspecialchars($row['uploaded_by']); ?></td>
                            <td>
                                <a href="<?php echo $row['file_path']; ?>" class="btn btn-success btn-sm" download><i
                                        class="fas fa-download"></i> Download</a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-delete btn-sm"><i
                                        class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No documents uploaded yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


</body>

</html>