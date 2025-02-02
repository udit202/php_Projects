
<?php
require 'conn.php';
?>
<?php

try {    
    // Data to insert
    $name = "Udit";
    $mobile = "8685873432";
    $email = "uditdhimar91@gmail.com";
    $plainPassword = "Admin@123";

    // Generate a unique ID using the current timestamp
    $uniqueId = uniqid("user_");

    // Hash the password
    $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

    // Insert data into the table
    $sql = "INSERT INTO Admin (name, mobile, gmail,unique_id, password) 
            VALUES ( '$name', '$mobile', '$email', '$uniqueId','$hashedPassword')";

    if (!mysqli_query($conn, $sql)) {
        throw new Exception("Error inserting data: " . mysqli_error($conn));
    }

    echo "Data inserted successfully with ID: " . $uniqueId;

    // Close connection
    mysqli_close($conn);
} catch (Exception $e) {
    // Redirect to index.html if an exception occurs
    header("Location: index.html");
    exit();
}
?>
