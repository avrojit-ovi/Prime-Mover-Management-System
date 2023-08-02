<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if (empty($name) || empty($username) || empty($email) || empty($phone) || empty($password) || empty($confirmPassword)) {
        $warningMsg = "All fields are required!";
    } elseif ($password !== $confirmPassword) {
        $warningMsg = "Password and Confirm Password do not match!";
    } else {
        // File upload handling
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $targetDir = 'assets/img/profile_pic/';
            $profilePicturePath = $targetDir . basename($_FILES['profile_picture']['name']);
            
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true); // Create the directory if it doesn't exist
            }
            
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicturePath)) {
                // Connect to the MySQL database
                require_once 'includes/db.php';
                // Hash the password before storing it in the database
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
                // Prepare and execute the SQL query to insert the user data into the database
                $sql = "INSERT INTO users (name, username, email, phone, password, profile_picture) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ssssss", $name, $username, $email, $phone, $hashedPassword, $profilePicturePath);
            
                if (mysqli_stmt_execute($stmt)) {
                    $successMsg = "Registration successful!";
                    header("Location: login.php");
                    exit; // Important: This ensures that no other output is sent before the redirect occurs.
                
                } else {
                    $warningMsg = "Error: " . mysqli_error($conn);
                }
            
                // Close the database connection
                mysqli_close($conn);
            } else {
                $warningMsg = "Failed to move the uploaded profile picture.";
            }
        } else {
            $warningMsg = "Profile picture upload error.";
        }
    }
}
?>
