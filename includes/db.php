<?php 

$dbHost = 'localhost';
$dbName = 'pmms';
$dbUsername = 'root';
$dbPassword = '';

$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>