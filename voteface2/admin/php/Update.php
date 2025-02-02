<?php
include 'db_connection.php';  // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $father_name = $_POST['father_name'];
    $mobile_number = $_POST['mobile_number'];
    $aadhar_number = $_POST['aadhar_number'];
    $status = $_POST['status'];

    // Validate input (you can add more validation as needed)
    if (empty($id) || empty($name) || empty($mobile_number) || empty($aadhar_number)) {
        echo '7';  // Missing required fields
        exit();
    }

    // Check if the mobile number already exists for another voter
    $query = "SELECT * FROM voters WHERE mobile_number = '$mobile_number' AND id != '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo '9';  // Mobile number already exists for another voter
        exit();
    }

    // Check if the Aadhar number already exists for another voter
    $query = "SELECT * FROM voters WHERE aadhar_number = '$aadhar_number' AND id != '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo '9';  // Aadhar number already exists for another voter
        exit();
    }

    // Update the voter's details in the database
    $query = "UPDATE voters SET name='$name', father_name='$father_name', 
              mobile_number='$mobile_number', aadhar_number='$aadhar_number', 
              status='$status' WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        echo '1';  // Successfully updated
    } else {
        echo '0';  // Error in update
    }

    mysqli_close($conn);  // Close the connection
}
?>
