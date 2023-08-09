<?php
require_once 'db.php';

if (isset($_POST['expense_id'])) {
    $expenseId = $_POST['expense_id'];
    $expenseName = $_POST['edit_expense_name'];
    $amount = $_POST['edit_amount'];
    $vendor = $_POST['edit_vendor']; // New field for Vendor
    $paidAmount = $_POST['edit_paid_amount']; // New field for Paid Amount
    $dueAmount = $_POST['edit_due_amount']; // New field for Due Amount
    $vehicleNumber = $_POST['edit_vehicle_number'];
    $expenseDate = $_POST['edit_expense_date'];

    $updateQuery = "UPDATE expenses SET expense_name = '$expenseName', amount = $amount, vendor = '$vendor', paid_amount = $paidAmount, due_amount = $dueAmount, vehicle_number = '$vehicleNumber', expense_date = '$expenseDate' WHERE id = $expenseId";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: ../expense.php?edit_success");
        exit();
    } else {
        header("Location: ../expense.php?edit_error");
        exit();
    }
} else {
    header("Location: ../expense.php");
    exit();
}
?>
