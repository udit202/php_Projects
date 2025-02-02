<?php
session_start();

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON payload
    $data = json_decode(file_get_contents('php://input'), true);

    // Get the Aadhaar number and image data
    $aadhar = isset($data['aadhar']) ? $data['aadhar'] : '';
    $imageData = isset($data['image']) ? $data['image'] : '';

    // Check if the Aadhaar and image data are provided
    if (empty($aadhar) || empty($imageData)) {
        echo json_encode(['success' => false, 'message' => 'Aadhaar or image data missing.']);
        exit();
    }

    // Clean the base64 data to remove extra characters
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData); // Fix for base64 encoding

    // Decode the base64 string
    $imageDecoded = base64_decode($imageData);
    if ($imageDecoded === false) {
        echo json_encode(['success' => false, 'message' => 'Failed to decode image data.']);
        exit();
    }

    // Generate a unique filename for the image
    $imageName = uniqid('voter_') . '.png';

    // Set the upload directory and check if it exists
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            echo json_encode(['success' => false, 'message' => 'Failed to create upload directory.']);
            exit();
        }
    }

    // Define the path to save the image
    $filePath = $uploadDir . $imageName;

    // Save the decoded image data to the file
    if (file_put_contents($filePath, $imageDecoded) === false) {
        echo json_encode(['success' => false, 'message' => 'Failed to save image file.']);
        exit();
    }

    // Store the image path in the session
    $_SESSION['captured_image'] = $filePath;

    // Optionally, you can update the image in the database here, if needed

    // Return a success response
    echo json_encode(['success' => true, 'message' => 'Image captured and saved successfully.']);
} else {
    // Return failure if it's not a POST request
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
