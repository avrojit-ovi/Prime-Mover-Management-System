<?php
// Include database connection
require_once 'db.php';

// Check if ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $tripId = $_GET['id'];

    // Delete the trip record from the database
    $deleteQuery = "DELETE FROM trip_record WHERE id = $tripId";

    if (mysqli_query($conn, $deleteQuery)) {
        // Redirect back to the addtrip.php page
        header("Location: ../addtrip.php");
        exit();
    } else {
        // Handle delete error
        echo "Error deleting trip record: " . mysqli_error($conn);
    }
} else {
    // Redirect to an error page or perform other actions
   
    exit();
}
?>
