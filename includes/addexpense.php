<?php
// Include database connection
require_once 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $expenseName = $_POST['expense_name'];
    $amount = $_POST['amount'];
    $vehicleNumber = $_POST['vehicle_number'];
    $expenseDate = $_POST['expense_date'];

    // Prepare and execute the SQL query to insert the expense record
    $query = "INSERT INTO expenses (expense_name, amount, vehicle_number, expense_date) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    
    mysqli_stmt_bind_param($stmt, "sdss", $expenseName, $amount, $vehicleNumber, $expenseDate);
    
    if (mysqli_stmt_execute($stmt)) {
        // Successful insertion
        mysqli_stmt_close($stmt);
        
        // Redirect back to the expense.php page
        header("Location: ../expense.php");
        exit();
    } else {
        // Error occurred
        $error = "Error: " . mysqli_error($conn);
        mysqli_stmt_close($stmt);
        
        // You can handle the error as needed, such as displaying an error message or logging it
        // For example: echo "Failed to insert expense: " . $error;
    }
}

// Close the database connection
mysqli_close($conn);
?>
