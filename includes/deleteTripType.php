<?php
require_once 'db.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $tripTypeId = $_GET['id'];

    // Delete the trip type from the database
    $deleteQuery = "DELETE FROM trip_type WHERE id = ?";
    
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param('i', $tripTypeId);
    
    if ($stmt->execute()) {
        header("Location: ../trip_type.php");
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}
?>
