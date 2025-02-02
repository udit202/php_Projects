<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Delete voter data
    $query = "DELETE FROM voters WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        echo '1'; // Success
    } else {
        echo '0'; // Deletion failed
    }
}
?>
