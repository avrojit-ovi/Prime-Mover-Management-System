<?php
// Start the session (assuming the user is already logged in and you've stored the user's name in the session)
require_once '../session.php';

// Include database connection
require_once 'db.php';

// Process form submission for adding a new employee
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['full_name'])) {
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $nid_licence_no = $_POST['nid_licence_no'];
    $joining_date = $_POST['joining_date'];
    $role = $_POST['role'];
    $salary = $_POST['salary'];
    $assigned_vehicle = $_POST['assigned_vehicle'];

    // Insert the data into the "employees" table
    $sql = "INSERT INTO employees (full_name, phone_number, nid_licence_no, joining_date, role, salary, assigned_vehicle) VALUES ('$full_name', '$phone_number', '$nid_licence_no', '$joining_date', '$role', '$salary', '$assigned_vehicle')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Redirect back to the same page after adding a new employee
        header('Location: ../employee.php');
exit();
    } } else {
        // Handle add error
        echo 'Error adding employee. Please try again. Error message: ' . mysqli_error($conn);
    }

?>
