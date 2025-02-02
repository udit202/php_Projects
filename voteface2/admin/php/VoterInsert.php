<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile']);
    $aadhar_number = mysqli_real_escape_string($conn, $_POST['aadhar']);
    
    // Check if mobile or Aadhar already exists
    $checkMobileQuery = "SELECT * FROM voters WHERE mobile_no = '$mobile_number'";
    $checkAadharQuery = "SELECT * FROM voters WHERE aadhar_no = '$aadhar_number'";

    $mobileResult = mysqli_query($conn, $checkMobileQuery);
    $aadharResult = mysqli_query($conn, $checkAadharQuery);

    if (mysqli_num_rows($mobileResult) > 0 || mysqli_num_rows($aadharResult) > 0) {
        echo '9'; // Mobile or Aadhar number already exists
        exit();
    }

    // Handle file upload
    if (isset($_FILES['voter_img']) && $_FILES['voter_img']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['voter_img']['tmp_name'];
        $fileName = $_FILES['voter_img']['name'];
        $fileSize = $_FILES['voter_img']['size'];
        $fileType = $_FILES['voter_img']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadDir = '../votersimg/';
            $newFileName = uniqid() . '.' . $fileExtension;
            $destPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Insert voter data into database
                $query = "INSERT INTO voters (name, father_name, mobile_no, aadhar_no, voter_img) 
                          VALUES ('$name', '$father_name', '$mobile_number', '$aadhar_number', '$newFileName')";
                if (mysqli_query($conn, $query)) {
                    echo '1'; // Success
                } else {
                    echo '0'; // Database insert failed
                }
            } else {
                echo '5'; // File upload failed
            }
        } else {
            echo '6'; // Invalid file type
        }
    } else {
        echo '8'; // No file uploaded
    }
}
?>
