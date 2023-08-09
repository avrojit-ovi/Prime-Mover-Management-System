<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $expenseId = $_POST['expense_id'];
    $expenseName = $_POST['edit_expense_name'];
    $amount = $_POST['edit_amount'];
    $vehicleNumber = $_POST['edit_vehicle_number'];
    $expenseDate = $_POST['edit_expense_date'];

    // Update expense record in the database
    $query = "UPDATE expenses
              SET expense_name = ?, amount = ?, vehicle_number = ?, expense_date = ?
              WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $expenseName, $amount, $vehicleNumber, $expenseDate, $expenseId);
    
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header('Location: ../expense.php'); // Redirect back to the expense page
        exit();
    } else {
        // Handle the error
        echo "Error: " . mysqli_error($conn);
    }
}
?>
