<?php
require_once 'db.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract data from the form
    $tripId = $_POST['tripNameSelect']; // Get the selected trip ID from the form
    $qnt = $_POST['QNT']; // Get the QNT value from the form
    $vehicleNumber = $_POST['vehicle_number'];
    $amount = $_POST['amount'];
    $driverAllowance = $_POST['driverAllowance'];
    $helperAllowance = $_POST['helperAllowance'];
    $driverName = $_POST['driver_name'];
    $helperName = $_POST['helper_name'];
    $tripDate = $_POST['trip_date'];

    // Retrieve the trip name from the database based on the selected trip ID
    $tripNameQuery = "SELECT trip_name FROM trip_type WHERE id = $tripId";
    $tripNameResult = mysqli_query($conn, $tripNameQuery);
    $tripNameRow = mysqli_fetch_assoc($tripNameResult);
    $tripName = $tripNameRow['trip_name'];



    // Insert data into the trip_record table
    $insertQuery = "INSERT INTO trip_record (trip_name, qnt, amount, driver_allowance, helper_allowance, driver_name, helper_name, trip_date, vehicle_number) VALUES ('$tripName', $qnt, $amount, $driverAllowance, $helperAllowance, '$driverName', '$helperName', '$tripDate', '$vehicleNumber')";

    if (mysqli_query($conn, $insertQuery)) {
        // Data inserted successfully
        header('location: ../addtrip.php');
    } else {
        // Error inserting data
        echo "Error: " . mysqli_error($conn);
    }
}
?>
