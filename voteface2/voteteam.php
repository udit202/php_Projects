<?php
session_start(); // Start the session

// Check if the captured image path and Aadhaar number are set in the session
if (!isset($_SESSION['captured_image_path']) || !isset($_SESSION['aadhar'])) {
    // Redirect back to vote.php if data is not set
    header("Location: vote.php");
    exit();
}

$aadhar = $_SESSION['aadhar']; // Get the Aadhaar number from the session
$imagePath = $_SESSION['captured_image_path']; // Get the captured image path from the session

// Include the database connection file
require_once 'conn.php';

// Check if the Aadhaar number exists in the 'vote' table (already voted)
$voteCheckQuery = "SELECT id FROM vote WHERE aadhaar_no = ?";
$stmt = $conn->prepare($voteCheckQuery);
$stmt->bind_param('s', $aadhar);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Aadhaar exists in vote table, alert and exit
    echo "<script>alert('You have already voted!'); window.location.href='vote.php';</script>";
    exit();
}

$stmt->close();

// Fetch voter data from the 'voters' table using the Aadhaar number
$voterQuery = "SELECT * FROM voters WHERE aadhar_no = ?";
$stmt = $conn->prepare($voterQuery);
$stmt->bind_param('s', $aadhar);
$stmt->execute();
$voterResult = $stmt->get_result();
$voterData = $voterResult->fetch_assoc();

// Fetch the team options from the 'team' table
$teamQuery = "SELECT * FROM team";
$teamResult = $conn->query($teamQuery);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voteTo = $_POST['vote_to']; // Get the selected team ID

    // Insert the vote into the 'vote' table
    $stmt = $conn->prepare("INSERT INTO vote (aadhaar_no, voter_img, vote_to) VALUES (?, ?, ?)");
    $stmt->bind_param('ssi', $aadhar, $imagePath, $voteTo);

    if ($stmt->execute()) {
        // Show alert and redirect to index.php after successful vote
        echo "<script>alert('Vote submitted successfully!'); window.location.href='index.php';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Team</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Vote Team</h2>

        <!-- Display the captured image -->
        <div class="text-center">
            <img src="<?php echo $imagePath; ?>" alt="Captured Voter Image" class="img-fluid rounded shadow" style="max-width: 300px;">
        </div>

        <!-- Display Voter Details -->
        <div class="mt-4">
            <h4 class="text-center">Voter Details</h4>
            <?php if ($voterData): ?>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($voterData['name']); ?></p>
                <p><strong>Father's Name:</strong> <?php echo htmlspecialchars($voterData['father_name']); ?></p>
                <p><strong>Mobile Number:</strong> <?php echo htmlspecialchars($voterData['mobile_no']); ?></p>
            <?php else: ?>
                <p class="text-danger">Voter details not found!</p>
            <?php endif; ?>

            <h4 class="text-center mt-4">Select Your Team</h4>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="vote_to" class="form-label">Choose your Team</label>
                    <select class="form-select" name="vote_to" id="vote_to" required>
                        <option value="" disabled selected>Select Team</option>

                        <?php if ($teamResult->num_rows > 0): ?>
                            <?php while ($team = $teamResult->fetch_assoc()): ?>
                                <option value="<?php echo $team['id']; ?>"><?php echo htmlspecialchars($team['name']); ?></option>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <option value="">No teams available</option>
                        <?php endif; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit Vote</button>
            </form>
        </div>
    </div>
</body>
</html>
