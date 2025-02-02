<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile']);
    $aadhar_number = mysqli_real_escape_string($conn, $_POST['aadhar']);

    // Check if mobile or Aadhar already exists (except for the current voter)
    $checkMobileQuery = "SELECT * FROM voters WHERE mobile_no = '$mobile_number' AND id != '$id'";
    $checkAadharQuery = "SELECT * FROM voters WHERE aadhar_no = '$aadhar_number' AND id != '$id'";

    $mobileResult = mysqli_query($conn, $checkMobileQuery);
    $aadharResult = mysqli_query($conn, $checkAadharQuery);

    if (mysqli_num_rows($mobileResult) > 0 || mysqli_num_rows($aadharResult) > 0) {
        echo '9'; // Mobile or Aadhar number already exists
        exit();
    }

    // Handle file upload if new file is uploaded
    $voter_img = "";
    if (isset($_FILES['voter_img']) && $_FILES['voter_img']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['voter_img']['tmp_name'];
        $fileName = $_FILES['voter_img']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadDir = '../votersimg/';
            $newFileName = uniqid() . '.' . $fileExtension;
            $destPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $voter_img = ", voter_img = '$newFileName'";
            } else {
                echo '5'; // File upload failed
                exit();
            }
        } else {
            echo '6'; // Invalid file type
            exit();
        }
    }

    // Update the voter data
    $query = "UPDATE voters SET name = '$name', father_name = '$father_name', mobile_no = '$mobile_number', aadhar_no = '$aadhar_number' $voter_img WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo '1'; // Success
    } else {
        echo '0'; // Database update failed
    }
}
?>
