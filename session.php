<?php

// Start the session (assuming the user is already logged in and you've stored the user's name in the session)
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Include the database connection file
require_once 'includes/db.php';

// Fetch the full name of the user using the user_id from the session
$sql = "SELECT name, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $user_id);
$stmt->execute();
$stmt->bind_result($name, $profile_pic);
$stmt->fetch();
$stmt->close();
?>