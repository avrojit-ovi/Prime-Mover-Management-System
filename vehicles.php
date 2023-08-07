<?php
// Start the session (assuming the user is already logged in and you've stored the user's name in the session)
require_once 'session.php';

// Include database connection and functions for edit and delete
require_once 'includes/db.php';
require_once 'includes/editVehicles.php';
require_once 'includes/deleteVehicle.php';

// Fetch all vehicles from the database
$query = "SELECT * FROM vehicles";
$result = mysqli_query($conn, $query);

// Process form submission for adding a new vehicle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vehicle_number'])) {
    $vehicle_number = $_POST['vehicle_number'];
    $sql = "INSERT INTO vehicles (vehicle_number) VALUES ('$vehicle_number')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Redirect back to the same page after adding a new vehicle
        header('Location: vehicles.php');
        exit();
    } else {
        // Handle add error
        echo 'Error adding vehicle. Please try again.';
    }
}

// Process editing of a vehicle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_vehicle_id'])) {
    $vehicle_id = $_POST['edit_vehicle_id'];
    $vehicle_number = $_POST['vehicle_number'];

    if (editVehicle($conn, $vehicle_id, $vehicle_number)) {
        // Redirect back to the same page after editing the vehicle
        header('Location: vehicles.php');
        exit();
    } else {
        // If edit failed, show an error message
        echo 'Error editing vehicle. Please try again.';
    }
}

// Process deletion of a vehicle
if (isset($_GET['delete_vehicle_id'])) {
    $vehicle_id = $_GET['delete_vehicle_id'];
    if (deleteVehicle($conn, $vehicle_id)) {
        // Redirect back to the same page after deleting the vehicle
        header('Location: vehicles.php');
        exit();
    } else {
        // If delete failed, show an error message
        echo 'Error deleting vehicle. Please try again.';
    }
}
?>

<html>
    <head>
        <meta charset="utf-8"/>
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

        <title>Dashboard - Prime Mover Management System</title>

        <meta name="description" content=""/>

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
                            <!-- Add vehicles button here -->
                            <!-- Button trigger modal -->
                            <div class="row">
                                <div class="col-md-3">
                                    <button
                                        type="button"
                                        class="btn rounded-pill btn-outline-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#vehiclesAddModal">Add Vehicles</button>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    <form class="d-flex">
                                        <input
                                            class="form-control me-2"
                                            type="search"
                                            id="table_search"
                                            placeholder="Search"
                                            aria-label="Search">
                                        <button class="btn btn-outline-primary" type="button" onclick="searchTable()">Search</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Vertically Centered Modal -->
                            <div class="col-lg-4 col-md-6">
                                <!-- Add Modal -->
                                <div class="modal fade" id="vehiclesAddModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="vehiclesAddModalTitle">Add Vehicles</h5>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="includes/addVehicle.php" method="post">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameWithTitle" class="form-label">Vehicle Number</label>
                                                            <input
                                                                type="text"
                                                                id="nameWithTitle"
                                                                class="form-control"
                                                                placeholder="Enter Name"
                                                                name="vehicle_number"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Add modal -->

                                <!-- Edit Modal -->
                                <div class="modal fade" id="vehiclesEditModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="vehiclesEditModalTitle">Edit Vehicles</h5>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form id="editForm" action="vehicles.php" method="post">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameWithTitle" class="form-label">Vehicle Number</label>
                                                            <input
                                                                type="text"
                                                                id="edit_vehicle_number"
                                                                class="form-control"
                                                                placeholder="Enter Name"
                                                                name="vehicle_number"/>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="edit_vehicle_id" name="edit_vehicle_id"/>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Edit modal -->
                            </div>

                            <div class="container-xxl flex-grow-1 container-p-y">
                                <!-- Table codes start here -->
                                <hr class="my-5"/>
                                <!-- Hoverable Table rows -->
                                <div class="card">
                                    <h5 class="card-header">All vehicles</h5>
                                    <div class="card-body">
                                        <div class="table-responsive text-nowrap ">
                                            <table class="table table-bordered table-hover text-center" id="vehiclesTable">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Vehicle No</th>
                                                        <th>Created Date</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                                    <tr>
                                                        <td><?php echo $row['vehicle_id']; ?></td>
                                                        <td><?php echo $row['vehicle_number']; ?></td>
                                                        <td>
                                                        <?php if (isset($row['created_at'])) {
        echo $row['created_at'];
    } else {
        echo 'N/A';
    } ?>
                                                        </td>
                                                        <td>
                                                        <button
                                                            type="button"
                                                            class="btn btn-sm btn-info invisible"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#vehiclesEditModal"
                                                            onclick="openEditModal(<?php echo $row['vehicle_id']; ?>, '<?php echo $row['vehicle_number']; ?>')">
                                                            Edit
                                                        </button>
                                                        <a
                                                            href="vehicles.php?delete_vehicle_id=<?php echo $row['vehicle_id']; ?>"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this vehicle?')">
                                                            Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--/ Hoverable Table rows -->
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

    <!-- JavaScript code for fetching and displaying data -->
    <script>
        function searchTable() {
            const keyword = document
                .getElementById('table_search')
                .value;
            fetch('search_vehicles.php?search=' + encodeURIComponent(keyword))
                .then(
                    response => response.json()
                )
                .then(data => {
                    const tableBody = document.querySelector('#vehiclesTable tbody');
                    tableBody.innerHTML = '';
                    if (data.length === 0) {
                        const newRow = tableBody.insertRow();
                        const newCell = newRow.insertCell();
                        newCell.colSpan = 4;
                        newCell.textContent = 'No results found.';
                    } else {
                        data.forEach(vehicle => {
                            const newRow = tableBody.insertRow();
                            newRow.innerHTML = `
                            <td>${vehicle.vehicle_id}</td>
                            <td>${vehicle.vehicle_number}</td>
                            <td>${vehicle.created_at}</td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-info"
                                    data-bs-toggle="modal"
                                    data-bs-target="#vehiclesEditModal"
                                    onclick="openEditModal(${vehicle.vehicle_id}, '${vehicle.vehicle_number}')"
                                >
                                    Edit
                                </button>
                                <a
                                    href="vehicles.php?delete_vehicle_id=${vehicle.vehicle_id}"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this vehicle?')"
                                >
                                    Delete
                                </a>
                            </td>
                        `;
                        });
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function openEditModal(vehicle_id, vehicle_number) {
            document
                .getElementById('edit_vehicle_id')
                .value = vehicle_id;
            document
                .getElementById('edit_vehicle_number')
                .value = vehicle_number;
        }
    </script>

</body>
</html>