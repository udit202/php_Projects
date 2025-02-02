<?php
session_start(); // Start the session to store data

// Get the image data and Aadhaar number from the incoming request
$data = json_decode(file_get_contents('php://input'), true);

// Check if both image data and Aadhaar number are available
if (isset($data['imageData']) && isset($data['aadhar'])) {
    $imageData = $data['imageData'];
    $aadhar = $data['aadhar'];

    // Decode the base64 image
    $image_parts = explode(";base64,", $imageData);
    if (count($image_parts) < 2) {
        echo json_encode(['success' => false, 'error' => 'Invalid image data']);
        exit();
    }
    
    $image_base64 = base64_decode($image_parts[1]);

    // Ensure the uploads directory exists
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Generate a unique filename with timestamp
    $fileName = 'voter_' . $aadhar . '_' . time() . '.png';
    $filePath = $uploadDir . $fileName;

    // Save the image file
    if (file_put_contents($filePath, $image_base64)) {
        // Store the image path and Aadhaar in session
        $_SESSION['captured_image_path'] = $filePath;
        $_SESSION['aadhar'] = $aadhar;

        // Return success with the stored file path
        echo json_encode(['success' => true, 'imagePath' => $filePath]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to save image']);
    }
} else {
    // If data is missing, return an error response
    echo json_encode(['success' => false, 'error' => 'Missing image data or Aadhaar number']);
}
?>
