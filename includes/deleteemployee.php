<?php
require_once '../session.php';
require_once 'db.php';

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    $delete_query = "DELETE FROM employees WHERE id = $employee_id";

    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        header("Location: ../employee.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
