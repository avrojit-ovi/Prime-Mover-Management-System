<?php
// Include database connection
require_once 'db.php';

// Check if form data was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $tripId = $_POST['editTripId'];
    $selectedTripId = $_POST['editTripName']; // New selected trip ID
    $vehicleNumber = $_POST['editVehicleNo'];
    $amount = $_POST['editAmount'];
    $driverName = $_POST['editDriverName'];
    $driverAllowance = $_POST['editDriverAllowance'];
    $helperName = $_POST['editHelperName'];
    $helperAllowance = $_POST['editHelperAllowance'];
    $tripDate = $_POST['editTripDate'];

    // Retrieve trip name based on selected trip ID
    $getTripNameQuery = "SELECT trip_name FROM trip_type WHERE id = $selectedTripId";
    $tripNameResult = mysqli_query($conn, $getTripNameQuery);
    $tripNameRow = mysqli_fetch_assoc($tripNameResult);
    $tripName = $tripNameRow['trip_name'];

    // Update the trip record in the database
    $updateQuery = "UPDATE trip_record SET
                    trip_name = '$tripName',
                    vehicle_number = '$vehicleNumber',
                    amount = '$amount',
                    driver_name = '$driverName',
                    driver_allowance = '$driverAllowance',
                    helper_name = '$helperName',
                    helper_allowance = '$helperAllowance',
                    trip_date = '$tripDate'
                    WHERE id = $tripId";

    if (mysqli_query($conn, $updateQuery)) {
        // Redirect back to the main page or perform other actions
        header("Location: ../addtrip.php");
        exit();
    } else {
        // Handle update error
        echo "Error updating trip record: " . mysqli_error($conn);
    }
} else {
    // Redirect to an error page or perform other actions
 
    exit();
}
?>
