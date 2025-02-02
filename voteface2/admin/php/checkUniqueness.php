<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
    $aadhar_number = mysqli_real_escape_string($conn, $_POST['aadhar_number']);
    $voter_id = mysqli_real_escape_string($conn, $_POST['voter_id']);

    // Check if mobile or Aadhar number exists for a different voter
    $checkMobileQuery = "SELECT * FROM voters WHERE mobile_no = '$mobile_number' AND id != '$voter_id'";
    $checkAadharQuery = "SELECT * FROM voters WHERE aadhar_no = '$aadhar_number' AND id != '$voter_id'";

    $mobileResult = mysqli_query($conn, $checkMobileQuery);
    $aadharResult = mysqli_query($conn, $checkAadharQuery);

    if (mysqli_num_rows($mobileResult) > 0 || mysqli_num_rows($aadharResult) > 0) {
        echo '0'; // Mobile or Aadhar already exists for another voter
    } else {
        echo '1'; // Unique
    }
}
?>
