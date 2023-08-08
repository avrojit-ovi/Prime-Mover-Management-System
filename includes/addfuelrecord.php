<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicleNumber = $_POST['vehicle_number'];
    $fuelLiter = $_POST['fuel_liter'];
    $fuelRate = $_POST['fuel_rate'];
    $driverName = $_POST['driver_name'];
    $fuelDate = $_POST['fuel_date'];

    $insertQuery = "INSERT INTO fuel_record (vehicle_number, fuel_liter, fuel_rate, driver_name, fuel_date)
                    VALUES ('$vehicleNumber', '$fuelLiter', '$fuelRate', '$driverName', '$fuelDate')";

    if (mysqli_query($conn, $insertQuery)) {
        header("location: ../fuel.php");
        echo "Fuel record added successfully.";
    } else {
        echo "Error adding fuel record: " . mysqli_error($conn);
    }
}
?>
