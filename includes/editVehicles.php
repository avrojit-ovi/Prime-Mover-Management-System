<?php

// Function to edit a vehicle in the database
function editVehicle($conn, $vehicle_id, $vehicle_number)
{
    // Prepare and execute the SQL update query
    $query = "UPDATE vehicles SET vehicle_number = ? WHERE vehicle_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'si', $vehicle_number, $vehicle_id);

    // Check if the update was successful
    $result = mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    return $result;
}
?>
