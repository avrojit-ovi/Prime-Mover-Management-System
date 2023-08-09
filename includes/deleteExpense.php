<?php
require_once 'db.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $expenseId = $_GET['id'];

    // Delete expense record from the database
    $query = "DELETE FROM expenses WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $expenseId);
    
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header('Location: ../expense.php'); // Redirect back to the expense page
        exit();
    } else {
        // Handle the error
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header('Location: ../expense.php'); // Redirect back to the expense page if ID is not provided
    exit();
}
?>
