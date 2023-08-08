<?php
require_once '../session.php';
require_once 'db.php';

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fuelId = $_POST['fuel_id'];
    $editVehicleNumber = $_POST['edit_vehicle_number'];
    $editFuelLiter = $_POST['edit_fuel_liter'];
    $editFuelRate = $_POST['edit_fuel_rate'];
    $editDriverName = $_POST['edit_driver_name'];
    $editFuelDate = $_POST['edit_fuel_date'];

    // Update the fuel record
    $updateQuery = "UPDATE fuel_record
                    SET vehicle_number = '$editVehicleNumber',
                        fuel_liter = '$editFuelLiter',
                        fuel_rate = '$editFuelRate',
                        driver_name = '$editDriverName',
                        fuel_date = '$editFuelDate'
                    WHERE id = $fuelId";

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['success_msg'] = "Fuel record updated successfully.";
        header("Location: ../fuel.php");
        exit();
    } else {
        $_SESSION['error_msg'] = "Error updating fuel record: " . mysqli_error($conn);
        header("Location: ../fuel.php");
        exit();
    }
} else {
    $_SESSION['error_msg'] = "Invalid request method.";
    header("Location: ../fuel.php");
    exit();
}
