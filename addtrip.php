<?php
// Start the session (assuming the user is already logged in and you've stored the user's name in the session)
require_once 'session.php';

// Include database connection
require_once 'includes/db.php';

// Check the database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

<html>
    <head>
        <meta charset="utf-8"/>
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

        <title>Expense Management System</title>

        <meta name="description" content=""/>

        <?php require_once "includes/css.php"; ?>
        <!-- Additional CSS or stylesheets can be included here -->

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

                        <!-- Add Trip Modal -->
                        <div
                            class="modal fade"
                            id="addTripModal"
                            tabindex="-1"
                            aria-labelledby="addTripModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addTripModalLabel">Add Trip Record</h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form to add a new trip record -->
                                        <form action="includes/insert_trip-rcd.php" method="post">
                                            <div class="row g-2">
                                                <div class="col-md-6 mb-3">
                                                <label for="tripNameSelect" class="form-label">Trip Name</label>
            <select class="form-select" id="tripNameSelect" name="tripNameSelect" onchange="updateFields1(this)">
            <option value="0" selected="selected" disabled="disabled">Please Select</option>
    <?php
    $queryTripTypes = "SELECT id, trip_name, amount, driver_allowance, helper_allowance FROM trip_type";
    $resultTripTypes = mysqli_query($conn, $queryTripTypes);
    while ($rowTripType = mysqli_fetch_assoc($resultTripTypes)) {
        echo '<option value="' . $rowTripType['id'] . '" data-amount="' . $rowTripType['amount'] . '" data-driver-allowance="' . $rowTripType['driver_allowance'] . '" data-helper-allowance="' . $rowTripType['helper_allowance'] . '">' . $rowTripType['trip_name'] . '</option>';
    }
    ?>
            </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="vehicleNo" class="form-label">Vehicle No</label>
                                                    <select id="vehicleNo" name="vehicle_number" class="form-select">
                                                        <?php
                                // Fetch vehicle numbers from the database
                                $queryVehicles = "SELECT vehicle_number FROM vehicles";
                                $resultVehicles = mysqli_query($conn, $queryVehicles);
                                while ($rowVehicle = mysqli_fetch_assoc($resultVehicles)) {
                                    echo '<option value="' . $rowVehicle['vehicle_number'] . '">' . $rowVehicle['vehicle_number'] . '</option>';
                                }
                                ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-4 mb-3">
                                                    <label for="amount" class="form-label">Amount</label>
                                                    <input type="text" class="form-control" id="amount" name="amount">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="driverAllowance" class="form-label">Driver Allowance</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="driverAllowance"
                                                        name="driverAllowance">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="helperAllowance" class="form-label">Helper Allowance</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="helperAllowance"
                                                        name="helperAllowance">
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-4 mb-3">
                                                    <label for="driverName" class="form-label">Driver</label>
                                                    <select
                                                        id="driverName"
                                                        name="driver_name"
                                                        class="form-select"
                                                        required="required">
                                                        <option value="" selected="selected" disabled="disabled">Please select</option>
                                                        <?php
                                // Fetch driver names from the database
                                $queryDrivers = "SELECT full_name FROM employees WHERE role = 'Driver'";
                                $resultDrivers = mysqli_query($conn, $queryDrivers);
                                while ($rowDriver = mysqli_fetch_assoc($resultDrivers)) {
                                    echo '<option value="' . $rowDriver['full_name'] . '">' . $rowDriver['full_name'] . '</option>';
                                }
                                ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="helperName" class="form-label">Helper</label>
                                                    <select
                                                        id="helperName"
                                                        name="helper_name"
                                                        class="form-select"
                                                        required="required">
                                                        <option value="" selected="selected" disabled="disabled">Please select</option>
                                                        <?php
                                // Fetch driver names from the database
                                $queryDrivers = "SELECT full_name FROM employees WHERE role = 'Helper'";
                                $resultDrivers = mysqli_query($conn, $queryDrivers);
                                while ($rowDriver = mysqli_fetch_assoc($resultDrivers)) {
                                    echo '<option value="' . $rowDriver['full_name'] . '">' . $rowDriver['full_name'] . '</option>';
                                }
                                ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="tripDate" class="form-label">Date</label>
                                                    <input
                                                        type="date"
                                                        id="tripDate"
                                                        name="trip_date"
                                                        class="form-control"
                                                        value="<?php echo date('Y-m-d'); ?>"
                                                        required="required">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn rounded-pill btn-outline-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn rounded-pill btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end of add trip modal -->

                        <!-- edit Trip Modal -->
                        <div
                            class="modal fade"
                            id="editTripModal"
                            tabindex="-1"
                            aria-labelledby="editTripModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editTripModalLabel">Edit Trip Record</h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form to add a new trip record -->
                                        <form action="includes/update_trip-rcd.php" method="post">
                                            <input type="hidden" id="editTripId" name="editTripId">
                                            <div class="row g-2">
                                                <div class="col-md-6 mb-3">
                                                    <label for="editTripName" class="form-label">Trip Name</label>
                                                    <select
    class="form-select"
    id="editTripName"
    name="editTripName"
    onchange="updateFields2(this)">
    <option value="0" selected="selected" disabled="disabled">Please Select</option>
    <?php
    $queryTripTypes = "SELECT id, trip_name, amount, driver_allowance, helper_allowance FROM trip_type";
    $resultTripTypes = mysqli_query($conn, $queryTripTypes);
    while ($rowTripType = mysqli_fetch_assoc($resultTripTypes)) {
        echo '<option value="' . $rowTripType['id'] . '" data-amount="' . $rowTripType['amount'] . '" data-driver-allowance="' . $rowTripType['driver_allowance'] . '" data-helper-allowance="' . $rowTripType['helper_allowance'] . '">' . $rowTripType['trip_name'] . '</option>';
    }
    ?>
</select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="editVehicleNo" class="form-label">Vehicle No</label>
                                                    <select id="editVehicleNo" name="editVehicleNo" class="form-select">
                                                        <?php
                                // Fetch vehicle numbers from the database
                                $queryVehicles = "SELECT vehicle_number FROM vehicles";
                                $resultVehicles = mysqli_query($conn, $queryVehicles);
                                while ($rowVehicle = mysqli_fetch_assoc($resultVehicles)) {
                                    echo '<option value="' . $rowVehicle['vehicle_number'] . '">' . $rowVehicle['vehicle_number'] . '</option>';
                                }
                                ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-4 mb-3">
                                                    <label for="editAmount" class="form-label">Amount</label>
                                                    <input type="text" class="form-control" id="editAmount" name="editAmount">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="editDriverAllowance" class="form-label">Driver Allowance</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="editDriverAllowance"
                                                        name="editDriverAllowance">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="editHelperAllowance" class="form-label">Helper Allowance</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="editHelperAllowance"
                                                        name="editHelperAllowance">
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-4 mb-3">
                                                    <label for="editDriverName" class="form-label">Driver</label>
                                                    <select
                                                        id="editDriverName"
                                                        name="editDriverName"
                                                        class="form-select"
                                                        required="required">
                                                        <option value="" selected="selected" disabled="disabled">Please select</option>
                                                        <?php
                                // Fetch driver names from the database
                                $queryDrivers = "SELECT full_name FROM employees WHERE role = 'Driver'";
                                $resultDrivers = mysqli_query($conn, $queryDrivers);
                                while ($rowDriver = mysqli_fetch_assoc($resultDrivers)) {
                                    echo '<option value="' . $rowDriver['full_name'] . '">' . $rowDriver['full_name'] . '</option>';
                                }
                                ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="editHelperName" class="form-label">Helper</label>
                                                    <select
                                                        id="editHelperName"
                                                        name="editHelperName"
                                                        class="form-select"
                                                        required="required">
                                                        <option value="" selected="selected" disabled="disabled">Please select</option>
                                                        <?php
                                // Fetch driver names from the database
                                $queryDrivers = "SELECT full_name FROM employees WHERE role = 'Helper'";
                                $resultDrivers = mysqli_query($conn, $queryDrivers);
                                while ($rowDriver = mysqli_fetch_assoc($resultDrivers)) {
                                    echo '<option value="' . $rowDriver['full_name'] . '">' . $rowDriver['full_name'] . '</option>';
                                }
                                ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="editTripDate" class="form-label">Date</label>
                                                    <input
                                                        type="date"
                                                        id="editTripDate"
                                                        name="editTripDate"
                                                        class="form-control"
                                                        value="<?php echo date('Y-m-d'); ?>"
                                                        required="required">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn rounded-pill btn-outline-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn rounded-pill btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end of edit trip modal -->

                       

                        <div class="container-xxl flex-grow-1 container-p-y">
                            <!-- Add the following code above the "Button trigger modal" section -->

                            <div class="row mb-3">

                                <!-- Content -->
                                <div class="container-xxl flex-grow-1 container-p-y">

                                    <!-- Button trigger modal -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <button
                                                type="button"
                                                class="btn rounded-pill btn-outline-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#addTripModal">
                                                <i class="fa-solid fa-gas-pump"></i>
                                                Add Trip Record</button>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="row mb-3">
                                                <div class="col-md-4">

                                                    <input type="date" id="fromDate" class="form-control" title="From Date">
                                                </div>
                                                <div class="col-md-4">

                                                    <input type="date" id="toDate" class="form-control" title="To date">
                                                </div>
                                                <div class="col-md-4">
                                                    <button
                                                        class="btn rounded-pill btn-outline-primary"
                                                        onclick="applyDateFilter()">Apply Date Filter</button>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            <form class="d-flex">
                                                <input
                                                    class="form-control me-2"
                                                    type="search"
                                                    id="table_search"
                                                    placeholder="Search by name, phone, role, salary, NID, date, vehicle..."
                                                    aria-label="Search">
                                                <button class="btn btn-outline-primary" type="button" onclick="searchTable()">
                                                    <i class='bx bx-search'></i>
                                                </button>&nbsp;&nbsp;&nbsp;&nbsp;

                                            </form>
                                        </div>

                                    </div>
                                    <!-- Hoverable Table rows -->
                                    <div id="printable-content">
                                        <div class="card">
                                            <h5 class="card-header d-flex justify-content-between align-items-center">
                                                Expense Record
                                                <div>
                                                    <button class="btn rounded-pill btn-outline-primary" onclick="printTable()">
                                                        <i class='bx bx-printer'></i>
                                                    </button>
                                                    <button class="btn rounded-pill  btn-outline-info" onclick="reloadTable()">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </div>
                                            </h5>

                                            <div class="card-body">
                                                <div class="table-responsive text-nowrap ">
                                                    <table
                                                        class="table table-bordered text-nowrap table-hover table-striped text-center"
                                                        id="tripTable">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Trip</th>
                                                                <th>Vehicle No</th>
                                                                <th>Amount</th>
                                                                <th colspan="2">Driver</th>
                                                                <th colspan="2">Helper</th>

                                                                <th>Date</th>
                                                                <th>Actions</th>
                                                                <th>Remark</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="table-border-bottom-0">
                                                            <?php

// Fetch trip records from the database
$queryTripRecords = "SELECT * FROM trip_record";
$resultTripRecords = mysqli_query($conn, $queryTripRecords);

 while ($rowTrip = mysqli_fetch_assoc($resultTripRecords)) {
            ?>
                                                            <tr>
                                                                <td><?php echo $rowTrip['id'] ;?></td>
                                                                <td><?php echo $rowTrip['trip_name'] ;?></td>
                                                                <td><?php echo $rowTrip['vehicle_number'] ;?></td>
                                                                <td><?php echo $rowTrip['amount'] ;?></td>
                                                                <td><?php echo $rowTrip['driver_name'] ;?></td>
                                                                <td><?php echo $rowTrip['driver_allowance'] ;?></td>
                                                                <td><?php echo $rowTrip['helper_name']  ;?></td>
                                                                <td><?php echo $rowTrip['helper_allowance']  ;?></td>
                                                                <td><?php echo $rowTrip['trip_date']  ;?></td>

                                                                <td>
                                                                <button
    type="button"
    class="btn rounded-pill btn-sm btn-outline-info edit-button"
    data-bs-toggle="modal"
    data-bs-target="#editTripModal"
    onclick="populateEditModal(
        <?php echo $rowTrip['id']; ?>,
        '<?php echo $rowTrip['trip_name']; ?>',
        '<?php echo $rowTrip['vehicle_number']; ?>',
        <?php echo $rowTrip['amount']; ?>,
        '<?php echo $rowTrip['driver_name']; ?>',
        <?php echo $rowTrip['driver_allowance']; ?>,
        '<?php echo $rowTrip['helper_name']; ?>',
        <?php echo $rowTrip['helper_allowance']; ?>,
        '<?php echo $rowTrip['trip_date']; ?>'
    )">
    <i class="fa-regular fa-pen-to-square"></i>
</button>

                                                                    <a
                                                                        href="includes/deletetrip.php?id=<?php echo $rowTrip['id']; ?>"
                                                                        class="btn rounded-pill btn-sm btn-outline-danger"
                                                                        onclick="return confirm('Are you sure you want to delete this trip record?')">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                                <td></td>

                                                            </tr>
                                                            <?php    }    ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Hoverable Table rows -->
                                </div>
                                <!-- / Content -->

                            </div>
                            <!-- Content wrapper -->

                        </div>
                        <!-- / Layout page -->
                    </div>
                    <!-- Footer -->
                    <?php include "includes/footnav.php"; ?>
                    <!-- / Footer -->
                    <!-- Overlay -->
                    <div class="layout-overlay layout-menu-toggle"></div>
                </div>
                <!-- / Layout wrapper -->

                <!-- Core JS -->
                <?php require_once 'includes/js.php'; ?>

                <!-- JavaScript code for handling edit modal -->
                <script>
                 function updateFields1(selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const amountInput = document.getElementById('amount');
    const driverAllowanceInput = document.getElementById('driverAllowance');
    const helperAllowanceInput = document.getElementById('helperAllowance');

    // Set values based on the selected option's data attributes
    amountInput.value = selectedOption.getAttribute('data-amount');
    driverAllowanceInput.value = selectedOption.getAttribute('data-driver-allowance');
    helperAllowanceInput.value = selectedOption.getAttribute('data-helper-allowance');
}

function updateFields2(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const amountInput = document.querySelector('#editAmount');
        const driverAllowanceInput = document.querySelector('#editDriverAllowance');
        const helperAllowanceInput = document.querySelector('#editHelperAllowance');

        // Set values based on the selected option's data attributes
        amountInput.value = selectedOption.getAttribute('data-amount');
        driverAllowanceInput.value = selectedOption.getAttribute('data-driver-allowance');
        helperAllowanceInput.value = selectedOption.getAttribute('data-helper-allowance');
    }


                    //edit modal code here 
function populateEditModal(id, trip, vehicleNo, amount, driverName, driverAllowance, helperName, helperAllowance, tripDate) {
    const editModal = document.getElementById('editTripModal');
    const editForm = editModal.querySelector('form');

    // Set values in the form fields
    editForm.querySelector('#editTripId').value = id;
    
    // Set the selected option for the trip name
    const tripSelect = editForm.querySelector('#editTripName');
    for (let option of tripSelect.options) {
        if (option.textContent === trip) {
            option.selected = true;
            break;
        }
    }

    editForm.querySelector('#editVehicleNo').value = vehicleNo;
    editForm.querySelector('#editAmount').value = amount;
    editForm.querySelector('#editDriverName').value = driverName;
    editForm.querySelector('#editDriverAllowance').value = driverAllowance;
    editForm.querySelector('#editHelperName').value = helperName;
    editForm.querySelector('#editHelperAllowance').value = helperAllowance;
    editForm.querySelector('#editTripDate').value = tripDate;

    // Show the edit modal
    const bootstrapModal = new bootstrap.Modal(editModal);
    bootstrapModal.show();
    
}



                    // search box javascript code here

                    function searchTable() {
                        const searchValue = document
                            .getElementById('table_search')
                            .value
                            .toLowerCase();
                        const table = document.getElementById('tripTable');
                        const rows = table.getElementsByTagName('tr');

                        for (let i = 1; i < rows.length; i++) { // Start from index 1 to exclude the header row
                            const row = rows[i];
                            const columns = row.getElementsByTagName('td');
                            let shouldDisplay = false;

                            for (let column of columns) {
                                const columnText = column
                                    .textContent
                                    .toLowerCase();
                                if (columnText.indexOf(searchValue) > -1) {
                                    shouldDisplay = true;
                                    break;
                                }
                            }

                            row.style.display = shouldDisplay
                                ? ''
                                : 'none';
                        }
                    }

                    //reload table with reload button
                    function reloadTable() {
                        // Show all rows
                        const rows = document.querySelectorAll('#tripTable tbody tr');
                        rows.forEach(row => {
                            row.style.display = '';
                        });

                        // Remove "No data found" message if present
                        const noDataRow = document.querySelector('#tripTable tbody tr.no-data-row');
                        if (noDataRow) {
                            noDataRow.remove();
                        }
                    }
                </script>

            </body>
        </html>