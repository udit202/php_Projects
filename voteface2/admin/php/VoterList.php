<?php
include 'conn.php';

$query = "SELECT * FROM voters";
$result = mysqli_query($conn, $query);

$voters = array();
while ($row = mysqli_fetch_assoc($result)) {
    $voters[] = $row;
}

echo json_encode($voters); // Return data as JSON
?>
