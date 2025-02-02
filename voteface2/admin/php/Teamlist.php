<?php
// Include your database connection file
require 'conn.php';

// SQL query to fetch the team details (ID, name, and logo)
$sql = "SELECT id, name, logo FROM team";

// Execute the query
$result = $conn->query($sql);

// Initialize an array to store the team data
$teams = array();

// Check if there are any teams in the result
if ($result->num_rows > 0) {
    // Fetch each row and store it in the $teams array
    while ($row = $result->fetch_assoc()) {
        $teams[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'logo' => $row['logo']
        );
    }

    // Return the data as JSON
    echo json_encode($teams);
} else {
    // If no teams are found, return an empty array
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>
