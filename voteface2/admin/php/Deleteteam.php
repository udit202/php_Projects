<?php
require 'conn.php'; // Include your database connection

if (isset($_POST['id'])) {
    $teamId = $_POST['id']; // Get the team ID from the POST request

    // Fetch the logo file name for the team before deletion
    $sql = "SELECT logo FROM team WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $teamId);
    $stmt->execute();
    $stmt->bind_result($logo);
    $stmt->fetch();
    $stmt->close();

    // If logo exists, delete the image file from the server
    if ($logo) {
        $imagePath = '../uploads/' . $logo;
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the image file
        }
    }

    // Delete the team record from the database
    $sql = "DELETE FROM team WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $teamId);

    if ($stmt->execute()) {
        echo "1"; // Success
    } else {
        echo "0"; // Failure
    }

    $stmt->close();
} else {
    echo "0"; // If ID is not set
}

$conn->close();
?>
