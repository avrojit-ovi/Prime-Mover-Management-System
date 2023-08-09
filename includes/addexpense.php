<?php
// Include database connection
require_once 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get input values from the form
    $expenseName = $_POST['expense_name'];
    $amount = $_POST['amount'];
    $vehicleNumber = $_POST['vehicle_number'];
    $expenseDate = $_POST['expense_date'];
    $vendor = $_POST['vendor'];
    $paidAmount = $_POST['paid_amount'];
    $dueAmount = $_POST['due_amount']; // This will be calculated later

    // Insert data into the expenses table
    $insertQuery = "INSERT INTO expenses (expense_name, amount, vehicle_number, expense_date, vendor, paid_amount, due_amount)
                    VALUES ('$expenseName', '$amount', '$vehicleNumber', '$expenseDate', '$vendor', '$paidAmount', '$dueAmount')";

    if (mysqli_query($conn, $insertQuery)) {
        // Calculate due amount
        $dueAmount = $amount - $paidAmount;

        // Update the due amount in the database
        $updateDueQuery = "UPDATE expenses SET due_amount = '$dueAmount' WHERE expense_name = '$expenseName' AND expense_date = '$expenseDate'";
        mysqli_query($conn, $updateDueQuery);

        // Redirect back to the main page or display a success message
        header('Location: ../expense.php');
    } else {
        // Handle error, maybe redirect back with an error message
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>
