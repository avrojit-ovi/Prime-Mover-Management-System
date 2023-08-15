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
 
        

        <!-- Add Trip Modal -->
        <div class="modal fade" id="addTripModal" tabindex="-1" aria-labelledby="addTripModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTripModalLabel">Add Trip</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form to add a new trip -->
                        <form action="includes/insert_trip.php" method="post">
                            <div class="mb-3">
                                <label for="tripName" class="form-label">Trip Name</label>
                                <input type="text" class="form-control" id="tripName" name="tripName" required>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" required>
                            </div>
                            <div class="mb-3">
                                <label for="driverAllowance" class="form-label">Driver Allowance</label>
                                <input type="number" class="form-control" id="driverAllowance" name="driverAllowance" required>
                            </div>
                            <div class="mb-3">
                                <label for="helperAllowance" class="form-label">Helper Allowance</label>
                                <input type="number" class="form-control" id="helperAllowance" name="helperAllowance" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Trip</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Trip Type Modal -->
<div class="modal fade" id="editTripTypeModal" tabindex="-1" aria-labelledby="editTripTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTripTypeModalLabel">Edit Trip Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to edit trip type data -->
                <form id="editTripTypeForm" method="post" action="includes/update_trip_type.php">
                <input type="hidden" id="editTripTypeId" name="editTripTypeId">

                    <div class="mb-3">
                        <label for="editTripName" class="form-label">Trip Name</label>
                        <input type="text" class="form-control" id="editTripName" name="editTripName">
                    </div>
                    <div class="mb-3">
                        <label for="editAmount" class="form-label">Amount</label>
                        <input type="text" class="form-control" id="editAmount" name="editAmount">
                    </div>
                    <div class="mb-3">
                        <label for="editDriverAllowance" class="form-label">Driver Allowance</label>
                        <input type="text" class="form-control" id="editDriverAllowance" name="editDriverAllowance">
                    </div>
                    <div class="mb-3">
                        <label for="editHelperAllowance" class="form-label">Helper Allowance</label>
                        <input type="text" class="form-control" id="editHelperAllowance" name="editHelperAllowance">
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
    
    <!-- / Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Fetch trip types from the database -->
              <!-- Add Trip Modal Button -->
       <div>
       <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTripModal">
            Add Trip
        </button>
       </div>
        <br>
<?php
$queryTripTypes = "SELECT * FROM trip_type";
$resultTripTypes = mysqli_query($conn, $queryTripTypes);
?>
            <div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id="tripTypeTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Trip Name</th>
                <th>Amount</th>
                <th>Driver Allowance</th>
                <th>Helper Allowance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($rowTripType = mysqli_fetch_assoc($resultTripTypes)) { ?>
                <tr>
                    <td><?php echo $rowTripType['id']; ?></td>
                    <td><?php echo $rowTripType['trip_name']; ?></td>
                    <td><?php echo $rowTripType['amount']; ?></td>
                    <td><?php echo $rowTripType['driver_allowance']; ?></td>
                    <td><?php echo $rowTripType['helper_allowance']; ?></td>
                    <td>
                        <button
                            type="button"
                            class="btn edit-btn btn-sm btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#editTripTypeModal"
                            data-id="<?php echo $rowTripType['id']; ?>"
                            data-trip-name="<?php echo $rowTripType['trip_name']; ?>"
                            data-amount="<?php echo $rowTripType['amount']; ?>"
                            data-driver-allowance="<?php echo $rowTripType['driver_allowance']; ?>"
                            data-helper-allowance="<?php echo $rowTripType['helper_allowance']; ?>">
                            Edit
                        </button>
                        <a
                            href="includes/deleteTripType.php?id=<?php echo $rowTripType['id']; ?>"
                            class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Are you sure you want to delete this trip type?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    var editButtons = document.querySelectorAll(".edit-btn");
    editButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            var id = button.getAttribute("data-id");
            var trip_name = button.getAttribute("data-trip-name");
            var amount = button.getAttribute("data-amount");
            var driver_allowance = button.getAttribute("data-driver-allowance");
            var helper_allowance = button.getAttribute("data-helper-allowance");

            document.getElementById("editTripTypeId").value = id;
            document.getElementById("editTripName").value = trip_name; // Corrected variable name
            document.getElementById("editAmount").value = amount;
            document.getElementById("editDriverAllowance").value = driver_allowance; // Corrected variable name
            document.getElementById("editHelperAllowance").value = helper_allowance; // Corrected variable name
        });
    });
});

</script>

  </body>
</html>
