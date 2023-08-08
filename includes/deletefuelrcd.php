<?php
require_once '../session.php';
require_once 'db.php';

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $fuelId = $_GET['id'];

    // Delete the fuel record
    $deleteQuery = "DELETE FROM fuel_record WHERE id = $fuelId";

    if (mysqli_query($conn, $deleteQuery)) {
        $_SESSION['success_msg'] = "Fuel record deleted successfully.";
        header("Location: ../fuel.php");
        exit();
    } else {
        $_SESSION['error_msg'] = "Error deleting fuel record: " . mysqli_error($conn);
      //  header("Location: ../fuel.php");
        exit();
    }
} else {
    $_SESSION['error_msg'] = "Invalid request.";
   // header("Location: ../fuel.php");
    exit();
}
