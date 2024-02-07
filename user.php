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

// Fetch the full name of the user using the user_id from the session...
$sql = "SELECT name, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $user_id);
$stmt->execute();
$stmt->bind_result($name, $profile_pic);
$stmt->fetch();
$stmt->close();
?>



<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Prime Mover Management System</title>

    <meta name="description" content="" />

   <?php require_once "includes/css.php"; ?>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
       <?php include_once 'includes/menu.php' ?>

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

         <?php include_once 'includes/navbar.php' ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
              
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <?php include "includes/footnav.php"; ?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->
<?php require_once 'includes/js.php'; ?>
  </body>
</html>
