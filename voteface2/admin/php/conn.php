<?php
// Database configuration
$servername = "MYSQL1001.site4now.net";
$username = "ab238a_aditya";
$password = "Aditya@1237";
$dbname = "db_ab238a_aditya"; // Updated database name

try {
    // Create database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        throw new Exception("Database connection failed: " . mysqli_connect_error());
    }

} catch (Exception $e) {
    // Redirect to index.html if an exception occurs
    echo "Error: " . $e->getMessage();
    exit();
}
?>