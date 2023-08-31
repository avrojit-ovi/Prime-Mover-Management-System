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

                        <?php  include_once 'includes/trip4div.php'      ?>
                        <?php  include_once 'includes/tripAddModal.php'      ?>

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
                                                    <button class="btn rounded-pill btn-outline-primary" id="printButton">
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
                                                                <th>QNT</th>
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
                                                                <td><?php echo $rowTrip['qnt'] ;?></td>
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
        '<?php echo $rowTrip['qnt']; ?>',
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
                        driverAllowanceInput.value = selectedOption.getAttribute(
                            'data-driver-allowance'
                        );
                        helperAllowanceInput.value = selectedOption.getAttribute(
                            'data-helper-allowance'
                        );
                    }

                    function updateFields2(selectElement) {
                        const selectedOption = selectElement.options[selectElement.selectedIndex];
                        const amountInput = document.querySelector('#editAmount');
                        const driverAllowanceInput = document.querySelector('#editDriverAllowance');
                        const helperAllowanceInput = document.querySelector('#editHelperAllowance');

                        // Set values based on the selected option's data attributes
                        amountInput.value = selectedOption.getAttribute('data-amount');
                        driverAllowanceInput.value = selectedOption.getAttribute(
                            'data-driver-allowance'
                        );
                        helperAllowanceInput.value = selectedOption.getAttribute(
                            'data-helper-allowance'
                        );
                    }

                    // Quantity calculation code here
                    function calculateValues() {
                        const QNT = parseFloat(document.getElementById('QNT').value);
                        const amount = parseFloat(document.getElementById('tripNameSelect').options[
                            document
                                .getElementById('tripNameSelect')
                                .selectedIndex
                        ].getAttribute('data-amount'));
                        const driverAllowance = parseFloat(
                            document.getElementById('tripNameSelect').options[
                                document
                                    .getElementById('tripNameSelect')
                                    .selectedIndex
                            ].getAttribute('data-driver-allowance')
                        );
                        const helperAllowance = parseFloat(
                            document.getElementById('tripNameSelect').options[
                                document
                                    .getElementById('tripNameSelect')
                                    .selectedIndex
                            ].getAttribute('data-helper-allowance')
                        );

                        if (!isNaN(QNT) && !isNaN(amount) && !isNaN(driverAllowance) && !isNaN(helperAllowance)) {
                            const newAmount = QNT * amount;
                            const newDriverAllowance = QNT * driverAllowance;
                            const newHelperAllowance = QNT * helperAllowance;

                            document
                                .getElementById('amount')
                                .value = newAmount.toFixed(2);
                            document
                                .getElementById('driverAllowance')
                                .value = newDriverAllowance.toFixed(2);
                            document
                                .getElementById('helperAllowance')
                                .value = newHelperAllowance.toFixed(2);
                        }
                    }
                    //edit modal code here
                    function populateEditModal(
                        id,
                        trip,
                        qnt,
                        vehicleNo,
                        amount,
                        driverName,
                        driverAllowance,
                        helperName,
                        helperAllowance,
                        tripDate
                    ) {
                        const editModal = document.getElementById('editTripModal');
                        const editForm = editModal.querySelector('form');

                        // Set values in the form fields
                        editForm
                            .querySelector('#editTripId')
                            .value = id;

                        // Set the selected option for the trip name
                        const tripSelect = editForm.querySelector('#editTripName');
                        for (let option of tripSelect.options) {
                            if (option.textContent === trip) {
                                option.selected = true;
                                break;
                            }
                        }

                        editForm
                            .querySelector('#editVehicleNo')
                            .value = vehicleNo;
                        editForm
                            .querySelector('#editQNT')
                            .value = qnt;
                        editForm
                            .querySelector('#editAmount')
                            .value = amount;
                        editForm
                            .querySelector('#editDriverName')
                            .value = driverName;
                        editForm
                            .querySelector('#editDriverAllowance')
                            .value = driverAllowance;
                        editForm
                            .querySelector('#editHelperName')
                            .value = helperName;
                        editForm
                            .querySelector('#editHelperAllowance')
                            .value = helperAllowance;
                        editForm
                            .querySelector('#editTripDate')
                            .value = tripDate;

                        // Show the edit modal
                        const bootstrapModal = new bootstrap.Modal(editModal);
                        bootstrapModal.show();

                    }
                    // JavaScript code for handling edit modal
                    function updateFields2(selectElement) {
                        const selectedOption = selectElement.options[selectElement.selectedIndex];
                        const amountInput = document.querySelector('#editAmount');
                        const driverAllowanceInput = document.querySelector('#editDriverAllowance');
                        const helperAllowanceInput = document.querySelector('#editHelperAllowance');
                        const qntInput = document.querySelector('#editQNT'); // Added this line

                        // Set values based on the selected option's data attributes
                        amountInput.value = selectedOption.getAttribute('data-amount');
                        driverAllowanceInput.value = selectedOption.getAttribute(
                            'data-driver-allowance'
                        );
                        helperAllowanceInput.value = selectedOption.getAttribute(
                            'data-helper-allowance'
                        );

                        // Calculate updated values based on QNT
                        calculateUpdatedValues(
                            amountInput,
                            qntInput,
                            driverAllowanceInput,
                            helperAllowanceInput
                        );
                    }

                    // Function to calculate updated values based on QNT
                    function calculateUpdatedValues(
                        amountInput,
                        qntInput,
                        driverAllowanceInput,
                        helperAllowanceInput
                    ) {
                        const amount = parseFloat(amountInput.value);
                        const qnt = parseFloat(qntInput.value);
                        const driverAllowance = parseFloat(driverAllowanceInput.value);
                        const helperAllowance = parseFloat(helperAllowanceInput.value);

                        if (!isNaN(amount) && !isNaN(qnt) && !isNaN(driverAllowance) && !isNaN(helperAllowance)) {
                            const updatedAmount = amount * qnt;
                            const updatedDriverAllowance = driverAllowance * qnt;
                            const updatedHelperAllowance = helperAllowance * qnt;

                            amountInput.value = updatedAmount.toFixed(2);
                            driverAllowanceInput.value = updatedDriverAllowance.toFixed(2);
                            helperAllowanceInput.value = updatedHelperAllowance.toFixed(2);
                        }
                    }

                    // Attach input event listener to QNT input in edit modal
                    document
                        .querySelector('#editQNT')
                        .addEventListener('input', function () {
                            const amountInput = document.querySelector('#editAmount');
                            const driverAllowanceInput = document.querySelector('#editDriverAllowance');
                            const helperAllowanceInput = document.querySelector('#editHelperAllowance');
                            calculateUpdatedValues(
                                amountInput,
                                this,
                                driverAllowanceInput,
                                helperAllowanceInput
                            );
                        });
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

                    // date filter code here
                    function applyDateFilter() {
                        const fromDate = document
                            .getElementById('fromDate')
                            .value;
                        const toDate = document
                            .getElementById('toDate')
                            .value;
                        const table = document.getElementById('tripTable');
                        const rows = table.getElementsByTagName('tr');

                        for (let i = 1; i < rows.length; i++) { // Start from index 1 to exclude the header row
                            const row = rows[i];
                            const dateCell = row
                                .cells[8]
                                .textContent; // Assuming date is in the 9th column (index 8)

                            if ((fromDate === '' || dateCell >= fromDate) && (toDate === '' || dateCell <= toDate)) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
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

                    // Attach click event to the print button
                    const printButton = document.getElementById('printButton');
                    printButton.addEventListener('click', () => {
                        printTableContent();
                    });

                    // Function to print the table content
                    function printTableContent() {
                        // Clone the table to remove the action row and styling
                        const clonedTable = document
                            .getElementById('tripTable')
                            .cloneNode(true);

                        // Remove the action row
                        const actionColumnIndex = clonedTable
                            .rows[0]
                            .cells
                            .length - 2; // Adjust for the Remark column
                        for (let i = 0; i < clonedTable.rows.length; i++) {
                            clonedTable
                                .rows[i]
                                .deleteCell(actionColumnIndex);
                        }

                        // Remove action data from the cloned table
                        for (let i = 1; i < clonedTable.rows.length; i++) {
                            clonedTable
                                .rows[i]
                                .deleteCell(actionColumnIndex);
                        }

                        // Create a new window for printing
                        const printWindow = window.open('', '_blank');
                        printWindow
                            .document
                            .open();
                        printWindow
                            .document
                            .write(
                                `
        <html>
            <head>
                <title>Print Table</title>
                <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                    border: 1px solid #000; /* Border style for the table */
                }
                
                th, td {
                    border: 1px solid #000; /* Border style for table cells */
                    padding: 8px;
                    text-align: left;
                }
                
                tr:nth-child(even) {
                    background-color: #f2f2f2; /* Alternate row striping */
                }
                </style>
            </head>
            <body>
                <h1>Table Name</h1>
                ${clonedTable.outerHTML}
            </body>
        </html>
    `
                            );
                        printWindow
                            .document
                            .close();

                        // Print the new window
                        printWindow.print();
                    }
                </script>

            </body>
        </html>