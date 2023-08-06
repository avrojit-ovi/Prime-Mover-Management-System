<?php
// Function to delete a vehicle from the database
function deleteVehicle($conn, $vehicle_id)
{
    // Prepare and execute the SQL delete query
    $query = "DELETE FROM vehicles WHERE vehicle_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $vehicle_id);

    // Check if the delete was successful
    $success = mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    return $success;
}
?>
