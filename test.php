<?php      
include 'includes/db.php';
$testQuery = "SELECT * FROM employees";
$testResult = mysqli_query($conn, $testQuery);

if ($testResult) {
    while ($row = mysqli_fetch_assoc($testResult)) {
        print_r($row); // Output the retrieved data
    }
} else {
    echo "Error executing test query: " . mysqli_error($conn);
}

?>