<?php
// save_image.php

// Create the uploads directory if it doesn't exist
$uploadDir = 'uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Get the base64 encoded image data from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$imageData = $data['imageData'];

// Decode the base64 string to get the binary data
$imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
$imageData = base64_decode($imageData);

// Generate a unique file name using current timestamp
$timestamp = time();
$fileName = $uploadDir . 'voter_' . $timestamp . '.jpg';

// Save the image to the file system
if (file_put_contents($fileName, $imageData)) {
    // Return the image path to the client
    echo json_encode(['success' => true, 'imagePath' => $fileName]);
} else {
    echo json_encode(['success' => false]);
}
?>
