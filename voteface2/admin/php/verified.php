<?php
// Include the database connection file
require 'conn.php';

// Start the session
session_start();

// Check if the user is authenticated (i.e., logged in)
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

// SQL query to fetch the required details where checked = 1
$query = "
    SELECT 
        `id`, 
        `name`, 
        `father_name`, 
        `father_occupation`, 
        `class`, 
        `stream`, 
        `school`, 
        `school_address`, 
        `contact_no`, 
        `self_address`, 
        `interested_in`, 
        `response`, 
        `handled_by`, 
        `emp_name`, 
        `status`, 
        `checked`, 
        `admission_year`, 
        `created_at` 
    FROM `enrollment_details` 
    WHERE `checked` = 1 AND `status` = 1 AND `Admision`=0
    ORDER BY `created_at` DESC
";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    echo json_encode(["error" => "Database query failed: " . mysqli_error($conn)]);
    exit();
}

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    $enrollments = [];
    
    // Fetch the data and populate the array
    while ($row = mysqli_fetch_assoc($result)) {
        $enrollments[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'father_name' => $row['father_name'],
            'father_occupation' => $row['father_occupation'],
            'class' => $row['class'],
            'stream' => $row['stream'],
            'school' => $row['school'],
            'school_address' => $row['school_address'],
            'contact_no' => $row['contact_no'],
            'self_address' => $row['self_address'],
            'interested_in' => $row['interested_in'],
            'response' => $row['response'],
            'handled_by' => $row['handled_by'],
            'emp_name' => $row['emp_name'],
            'status' => $row['status'],
            'checked' => $row['checked'],
            'admission_year' => $row['admission_year'],
            'created_at' => date('Y-m-d H:i:s', strtotime($row['created_at'])),
        ];
    }

    // Return the data as a JSON response
    echo json_encode($enrollments, JSON_PRETTY_PRINT);
} else {
    // No results found, return an empty array
    echo json_encode([]);
}

// Close the database connection
mysqli_close($conn);
?>
