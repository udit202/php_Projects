<?php
session_start();
require_once 'conn.php'; // Database connection

// Check if the Aadhaar and captured image are set in the session
if (isset($_SESSION['aadhar']) && isset($_SESSION['captured_image'])) {
    $aadhar = $_SESSION['aadhar'];
    $capturedImage = $_SESSION['captured_image'];

    // Check if a team is selected from the form
    if (isset($_POST['team_id'])) {
        $team_id = $_POST['team_id']; // The selected team's ID

        // Prepare the query to insert the vote into the database
        $query = "INSERT INTO vote (aadhaar_no, voter_img, vote_to) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi', $aadhar, $capturedImage, $team_id); // Bind the Aadhaar, image, and team ID

        // Execute the query
        if ($stmt->execute()) {
            // If the vote is successfully inserted, redirect with a success message to index.php
            echo "<script>alert('Your vote has been successfully submitted!'); window.location.href = 'index.php';</script>";
        } else {
            // If there was an error, display an error message
            echo "<script>alert('There was an error submitting your vote. Please try again.'); window.location.href = 'voteteam.php';</script>";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // If no team is selected, show an error
        echo "<script>alert('Please select a team to vote for.'); window.location.href = 'voteteam.php';</script>";
    }
} else {
    // If the session variables are not set, show an error
    echo "<script>alert('No Aadhaar or captured image found. Please try again.'); window.location.href = 'voteteam.php';</script>";
}

// Close the database connection
$conn->close();
?>
