
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['editTripTypeId'];
    $tripName = $_POST['editTripName'];
    $amount = $_POST['editAmount'];
    $driverAllowance = $_POST['editDriverAllowance'];
    $helperAllowance = $_POST['editHelperAllowance'];

    // Update the trip type data in the database
    $updateQuery = "UPDATE trip_type SET trip_name = ?, amount = ?, driver_allowance = ?, helper_allowance = ? WHERE id = ?";
    
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssss", $tripName, $amount, $driverAllowance, $helperAllowance, $id);
    
    if ($stmt->execute()) {
        header("Location: ../trip_type.php");
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}
?>
