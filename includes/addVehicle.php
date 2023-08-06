<?php
// Include the database connection file
require_once 'db.php';

// Process form submission for adding a new vehicle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vehicle_number'])) {
    $vehicle_number = $_POST['vehicle_number'];
    $sql = "INSERT INTO vehicles (vehicle_number) VALUES (?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $vehicle_number);

    if (mysqli_stmt_execute($stmt)) {
        // Close the statement
        mysqli_stmt_close($stmt);

        // Redirect back to the same page after adding a new vehicle
        header('Location: ../vehicles.php');
        exit();
    } else {
        // Handle add error
        echo 'Error adding vehicle. Please try again.';
    }
}
?>
