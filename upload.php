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

// Simulating client login (Replace with actual session logic)
$client_id = isset($_POST['client_id']) ? intval($_POST['client_id']) : 0;

if ($client_id == 0) {
    die("Client ID is missing!");
}

// Directory to store uploads
$upload_dir = "uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Function to handle image upload
function uploadImage($file, $upload_dir, $existing_file = null) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . "." . $ext;
        $filepath = $upload_dir . $filename;
        move_uploaded_file($file['tmp_name'], $filepath);
        return $filename;
    }
    return $existing_file; // Keep existing file if no new upload
}

// Fetch existing image paths from the database
$result = $conn->query("SELECT * FROM client_uploads WHERE client_id = $client_id");
$existing_data = $result->fetch_assoc();

// Get existing images
$existing_logo = $existing_data['logo'] ?? null;
$existing_favicon = $existing_data['favicon'] ?? null;
$existing_primary = $existing_data['primary_image'] ?? null;
$existing_gallery = json_decode($existing_data['gallery'], true) ?? [];

// Upload new images but retain old if not uploaded
$logo = isset($_FILES['logo']) ? uploadImage($_FILES['logo'], $upload_dir, $existing_logo) : $existing_logo;
$favicon = isset($_FILES['favicon']) ? uploadImage($_FILES['favicon'], $upload_dir, $existing_favicon) : $existing_favicon;
$primary = isset($_FILES['primary']) ? uploadImage($_FILES['primary'], $upload_dir, $existing_primary) : $existing_primary;

// Handle gallery images
$gallery = $existing_gallery; // Start with existing images
if (!empty($_FILES['gallery']['name'][0])) {
    foreach ($_FILES['gallery']['name'] as $key => $name) {
        $file = [
            'name' => $_FILES['gallery']['name'][$key],
            'type' => $_FILES['gallery']['type'][$key],
            'tmp_name' => $_FILES['gallery']['tmp_name'][$key],
            'error' => $_FILES['gallery']['error'][$key],
            'size' => $_FILES['gallery']['size'][$key]
        ];
        $uploaded_file = uploadImage($file, $upload_dir);
        if ($uploaded_file) {
            $gallery[] = $uploaded_file;
        }
    }
}
$gallery_json = json_encode($gallery);

// Update or Insert into database
if ($existing_data) {
    // Update existing client uploads
    $stmt = $conn->prepare("UPDATE client_uploads SET logo=?, favicon=?, primary_image=?, gallery=? WHERE client_id=?");
    $stmt->bind_param("ssssi", $logo, $favicon, $primary, $gallery_json, $client_id);
} else {
    // Insert new client uploads
    $stmt = $conn->prepare("INSERT INTO client_uploads (client_id, logo, favicon, primary_image, gallery) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $client_id, $logo, $favicon, $primary, $gallery_json);
}

$stmt->execute();
$stmt->close();
$conn->close();

// Redirect back to preview uploaded images
header("Location: AddClient.php?Id=" . $client_id);
exit();
?>
