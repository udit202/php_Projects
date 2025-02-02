<?php

require 'conn.php';

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name']; // Team name
    $logo = $_FILES['logo']; // Uploaded team logo

    // Validate fields
    if (empty($name) || empty($logo['name'])) {
        echo '7'; // Missing required fields
        exit;
    }

    // Check for duplicate team name
    $sql = "SELECT * FROM team WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo '9'; // Duplicate team name
        $stmt->close();
        exit;
    }
    $stmt->close();

    // Validate the image format (only JPG, PNG, or JPEG)
    $allowedFormats = ['jpg', 'jpeg', 'png'];
    $fileExtension = strtolower(pathinfo($logo['name'], PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedFormats)) {
        echo '8'; // Invalid image format
        exit;
    }

    // Validate image size (max 2MB)
    $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes
    if ($logo['size'] > $maxFileSize) {
        echo '10'; // Image size exceeds limit
        exit;
    }

    // Ensure the upload directory exists
    $uploadDir = '../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
    }

    // Generate a unique filename using time and a unique ID
    $fileName = time() . "_" . uniqid() . "." . $fileExtension;
    $targetFilePath = $uploadDir . $fileName;

    // Move the uploaded logo to the server directory
    if (move_uploaded_file($logo['tmp_name'], $targetFilePath)) {
        // Insert the team data into the database
        $insertSql = "INSERT INTO team (name, logo) VALUES (?, ?)";
        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param("ss", $name, $fileName);

        if ($stmt->execute()) {
            echo '1'; // Success
        } else {
            echo '0'; // Database error
        }
        $stmt->close();
    } else {
        echo '0'; // File upload failed
    }
}

$conn->close();

?>
