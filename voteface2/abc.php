<?php
session_start();
$error = '';
require_once 'conn.php';

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset'])) {
        session_destroy();
        header("Location: vote.php");
        exit();
    }

    if (!empty($_POST['aadhar'])) {
        $aadhar = $_POST['aadhar'];
        $query = "SELECT * FROM voters WHERE aadhar_no = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $aadhar);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['aadhar'] = $aadhar;
            $row = $result->fetch_assoc();
            $_SESSION['voter_img'] = 'admin/votersimg/' . $row['voter_img']; // Save image path
        } else {
            $error = "No voter found with this Aadhaar number.";
        }

        $stmt->close();
        $conn->close();
    } else {
        $error = "Please enter Aadhaar number.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-sm-6 col-md-4 my-5">
                <div class="shadow rounded p-4">
                    <h2 class="text-center">Voting</h2>
                    <form method="POST" action="">
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label class="form-label">Aadhaar No :</label>
                            <input type="text" class="form-control" name="aadhar" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Verify Aadhaar</button>
                    </form>
                    <form method="POST" action="" class="mt-3">
                        <button type="submit" name="reset" class="btn btn-warning w-100">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['aadhar'])): ?>
        <div class="container mt-5">
            <h3 class="text-center">Voter Details</h3>
            <div class="text-center">
                <img src="<?php echo $_SESSION['voter_img']; ?>" alt="Voter Image" class="img-fluid rounded shadow" style="max-width: 200px;">
            </div>
            
            <h3 class="text-center mt-4">Capture Image</h3>
            <video id="video" width="640" height="480" autoplay muted></video>
            <button id="capture-btn" class="btn btn-success mt-3">Capture Image</button>
        </div>

        <script>
            const video = document.getElementById('video');
            const captureButton = document.getElementById('capture-btn');
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            // Request access to the webcam
            navigator.mediaDevices.getUserMedia({ video: true })
                .then((stream) => {
                    video.srcObject = stream;
                })
                .catch((err) => {
                    console.log("Error: " + err);
                });

            // Capture image when button is clicked
            captureButton.addEventListener('click', () => {
                // Draw the image from the video stream onto the canvas
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                // Convert the image to a data URL
                const imageData = canvas.toDataURL('image/png');

                // Send the captured image to the server
                fetch('capture_image.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        aadhar: "<?php echo $_SESSION['aadhar']; ?>",
                        image: imageData
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        // Save image path to session and redirect
                        window.location.href = 'voteteam.php';
                    } else {
                        alert('Error capturing the image');
                    }
                })
                .catch(err => {
                    console.error('Error:', err);
                });
            });
        </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
