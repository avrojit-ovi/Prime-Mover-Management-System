<?php
require_once '../session.php';
require_once 'db.php';

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $nid_licence_no = $_POST['nid_licence_no'];
    $joining_date = $_POST['joining_date'];
    $role = $_POST['role'];
    $salary = $_POST['salary'];
    $assigned_vehicle = $_POST['assigned_vehicle'];

    $update_query = "UPDATE employees SET 
                        full_name = '$full_name', 
                        phone_number = '$phone_number', 
                        nid_licence_no = '$nid_licence_no', 
                        joining_date = '$joining_date', 
                        role = '$role', 
                        salary = '$salary', 
                        assigned_vehicle = '$assigned_vehicle' 
                    WHERE id = $employee_id";

    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        header("Location: ../employee.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
