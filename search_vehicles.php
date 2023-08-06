<?php

// Include the database connection file
require_once 'includes/db.php';

// Get the search keyword from the query parameter
$searchKeyword = $_GET['search'];

// Prepare the SQL statement with a placeholder for the search keyword
$sql = "SELECT * FROM Vehicles WHERE vehicle_number LIKE ?";
$stmt = $conn->prepare($sql);

// Bind the search keyword to the placeholder
$searchKeyword = "%{$searchKeyword}%";
$stmt->bind_param('s', $searchKeyword);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch data as an associative array
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Return data in JSON format
echo json_encode($data);
