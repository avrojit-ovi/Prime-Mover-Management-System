<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tripName = $_POST['tripName'];
    $amount = $_POST['amount'];
    $driverAllowance = $_POST['driverAllowance'];
    $helperAllowance = $_POST['helperAllowance'];

    $insertQuery = "INSERT INTO trip_type (trip_name, amount, driver_allowance, helper_allowance) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param('ssss', $tripName, $amount, $driverAllowance, $helperAllowance);

    if ($stmt->execute()) {
        header('Location: ../trip_type.php');
        exit();
    } else {
        // Handle the error
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}


?>
