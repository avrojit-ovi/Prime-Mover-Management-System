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
                        <!-- 4 divs codes start here -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <!-- Add the following code above the "Button trigger modal" section -->

                            <div class="row mb-3">

                               <?php    include ('includes/expense4div.php')    ?>

                      

                        <!-- add expense modal code start here -->

                        <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form action="includes/addexpense.php" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addExpenseModalTitle">Add Expense Record</h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-2">
                                                <div class="col-md-6 mb-3">
                                                    <label for="expenseName" class="form-label">Expense Name</label>
                                                    <input
                                                        type="text"
                                                        id="expenseName"
                                                        name="expense_name"
                                                        class="form-control"
                                                        placeholder="Enter Expense Name"
                                                        required="required">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="vendor" class="form-label">Vendor</label>
                                                    <input
                                                        type="text"
                                                        id="vendor"
                                                        name="vendor"
                                                        class="form-control"
                                                        placeholder="Enter Vendor">
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-4 mb-3">
                                                    <label for="amount" class="form-label">Amount</label>
                                                    <input
                                                        type="text"
                                                        id="amount"
                                                        name="amount"
                                                        class="form-control"
                                                        placeholder="Enter Amount"
                                                        required="required">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="paidAmount" class="form-label">Paid Amount</label>
                                                    <input
                                                        type="text"
                                                        id="paidAmount"
                                                        name="paid_amount"
                                                        class="form-control"
                                                        placeholder="Enter Paid Amount"
                                                        oninput="calculateDueAmount()">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="dueAmount" class="form-label">Due Amount</label>
                                                    <input
                                                        type="text"
                                                        id="dueAmount"
                                                        name="due_amount"
                                                        class="form-control"
                                                        placeholder="Due Amount"
                                                        readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="row g-2">
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
                                                <div class="col-md-6 mb-3">
                                                    <label for="expenseDate" class="form-label">Date</label>
                                                    <input
                                                        type="date"
                                                        id="expenseDate"
                                                        name="expense_date"
                                                        class="form-control"
                                                        value="<?php echo date('Y-m-d'); ?>"
                                                        required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- add expense modal code end here-->
                        <!-- Edit expense record Modal -->
                        <div class="modal fade" id="editExpenseModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form action="includes/editexpense.php" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Expense Record</h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" id="editExpenseId" name="expense_id">
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="editExpenseName" class="form-label">Expense Name</label>
                                                    <input
                                                        type="text"
                                                        id="editExpenseName"
                                                        name="edit_expense_name"
                                                        class="form-control"
                                                        placeholder="Enter Expense Name"/>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-3">
                                                    <label for="editAmount" class="form-label">Amount</label>
                                                    <input
                                                        type="text"
                                                        id="editAmount"
                                                        name="edit_amount"
                                                        class="form-control"
                                                        placeholder="Enter Amount"/>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="editVendor" class="form-label">Vendor</label>
                                                    <input
                                                        type="text"
                                                        id="editVendor"
                                                        name="edit_vendor"
                                                        class="form-control"
                                                        placeholder="Enter Vendor"/>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-3">
                                                    <label for="editPaidAmount" class="form-label">Paid Amount</label>
                                                    <input
                                                        type="text"
                                                        id="editPaidAmount"
                                                        name="edit_paid_amount"
                                                        class="form-control"
                                                        placeholder="Enter Paid Amount"/>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="editDueAmount" class="form-label">Due Amount</label>
                                                    <input
                                                        type="text"
                                                        id="editDueAmount"
                                                        name="edit_due_amount"
                                                        class="form-control text-danger"
                                                        readonly="readonly"/>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-3">
                                                    <label for="editVehicleNumber" class="form-label">Vehicle Number</label>
                                                    <select id="editVehicleNumber" name="edit_vehicle_number" class="form-select">
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
                                                <div class="col mb-3">
                                                    <label for="editExpenseDate" class="form-label">Expense Date</label>
                                                    <input
                                                        type="date"
                                                        id="editExpenseDate"
                                                        name="edit_expense_date"
                                                        class="form-control"
                                                        placeholder="Select Expense Date"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /Edit expense record Modal -->

                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">

                            <!-- Button trigger modal -->
                            <div class="row">
                                <div class="col-md-3">
                                    <button
                                        type="button"
                                        class="btn rounded-pill btn-outline-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addExpenseModal">
                                        <i class="fa-solid fa-gas-pump"></i>
                                        Add Expense Record</button>
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
                                        <button class="btn btn-outline-primary" type="button" onclick="searchTable()">Search</button>&nbsp;
                                        <button class="btn rounded-pill btn-sm btn-outline-info" onclick="reloadTable()">
            <i class="fas fa-sync-alt"></i>
        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- Hoverable Table rows -->
                            <div class="card">
<h5 class="card-header">Expense Record</h5>
   
   
                                
                               
                                <div class="card-body">
                                    <div class="table-responsive text-nowrap ">
                                        <table
                                            class="table table-bordered text-nowrap table-hover table-striped text-center"
                                            id="expenseTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Expense Name</th>
                                                    <th>Vendor</th>
                                                    <th>Amount</th>
                                                    <th>Paid Amount</th>
                                                    <th>Due Amount</th>
                                                    <th>Vehicle No.</th>
                                                    <th>Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php
                    // Fetch expense records from the database
                    $queryExpenses = "SELECT * FROM expenses";
                    $resultExpenses = mysqli_query($conn, $queryExpenses);
                    $serialNumber = 1;
                    while ($rowExpense = mysqli_fetch_assoc($resultExpenses)) {
                        ?>
                                                <tr>
                                                    <td><?php echo $serialNumber++; ?></td>
                                                    <td id="expenseName_<?php echo $rowExpense['id']; ?>"><?php echo $rowExpense['expense_name']; ?></td>

                                                    <td><?php echo $rowExpense['vendor']; ?></td>
                                                    <td><?php echo $rowExpense['amount']; ?></td>
                                                    <td ><?php echo $rowExpense['paid_amount']; ?></td>
                                                    <td class="text-danger"><?php echo $rowExpense['due_amount']; ?></td>
                                                    <td><?php echo $rowExpense['vehicle_number']; ?></td>
                                                    <td><?php echo $rowExpense['expense_date']; ?></td>
                                                    <td>
                                                        <button
                                                            type="button"
                                                            class="btn rounded-pill btn-sm btn-outline-info edit-button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editExpenseModal"
                                                            data-id="<?php echo $rowExpense['id']; ?>"
                                                            data-name="<?php echo $rowExpense['expense_name']; ?>"
                                                            data-amount="<?php echo $rowExpense['amount']; ?>"
                                                            data-vendor="<?php echo $rowExpense['vendor']; ?>"
                                                            data-paid-amount="<?php echo $rowExpense['paid_amount']; ?>"
                                                            data-due-amount="<?php echo $rowExpense['due_amount']; ?>"
                                                            data-vehicle="<?php echo $rowExpense['vehicle_number']; ?>"
                                                            data-date="<?php echo $rowExpense['expense_date']; ?>">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </button>
                                                        <a
                                                            href="includes/deleteExpense.php?id=<?php echo $rowExpense['id']; ?>"
                                                            class="btn rounded-pill btn-sm btn-outline-danger"
                                                            onclick="return confirm('Are you sure you want to delete this expense record?')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>

                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--/ Hoverable Table rows -->
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
        <!-- JavaScript code for populating the edit modal -->
       
        <script>
            // JavaScript code for populating the edit modal
            document.addEventListener("DOMContentLoaded", function () {
                var editButtons = document.querySelectorAll(".edit-button");
                editButtons.forEach(function (button) {
                    button.addEventListener("click", function () {
                        var id = button.getAttribute("data-id");
                        var name = button.getAttribute("data-name");
                        var amount = button.getAttribute("data-amount");
                        var vendor = button.getAttribute("data-vendor");
                        var paidAmount = button.getAttribute("data-paid-amount");
                        var dueAmount = button.getAttribute("data-due-amount");
                        var vehicle = button.getAttribute("data-vehicle");
                        var date = button.getAttribute("data-date");

                        document
                            .getElementById("editExpenseId")
                            .value = id;
                        document
                            .getElementById("editExpenseName")
                            .value = name;
                        document
                            .getElementById("editAmount")
                            .value = amount;
                        document
                            .getElementById("editVendor")
                            .value = vendor;
                        document
                            .getElementById("editPaidAmount")
                            .value = paidAmount;
                        document
                            .getElementById("editDueAmount")
                            .value = dueAmount;
                        document
                            .getElementById("editVehicleNumber")
                            .value = vehicle;
                        document
                            .getElementById("editExpenseDate")
                            .value = date;
                    });
                });
            });

            function applyDateFilter() {
    const fromDate = new Date(document.getElementById('fromDate').value);
    const toDate = new Date(document.getElementById('toDate').value);

    const rows = document.querySelectorAll('#expenseTable tbody tr');
    let dataFound = false;

    rows.forEach(row => {
        const expenseDateText = row.querySelector('td:nth-child(8)').textContent;
        const expenseDate = new Date(expenseDateText.replace(/-/g, '/'));

        if ((fromDate && expenseDate < fromDate) || (toDate && expenseDate > toDate)) {
            row.style.display = 'none';
        } else {
            row.style.display = '';
            dataFound = true;
        }
    });

      // Show "No data found" message if no filtered data is found
      if (!dataFound) {
        const noDataRow = document.createElement('tr');
        const noDataCell = document.createElement('td');
        noDataCell.setAttribute('colspan', '9');
        noDataCell.textContent = 'No data found';
        noDataRow.appendChild(noDataCell);
        document.querySelector('#expenseTable tbody').appendChild(noDataRow);
    }

    // Remove "No data found" row if data is found
    if (dataFound) {
        const noDataRow = document.querySelector('#expenseTable tbody tr.no-data-row');
        if (noDataRow) {
            noDataRow.remove();
        }
    }
}


            // search box javascript code here

            function searchTable() {
                const searchValue = document
                    .getElementById('table_search')
                    .value
                    .toLowerCase();
                const table = document.getElementById('expenseTable');
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
            // add modal due and paid amount calculation code here
            function calculateDueAmount() {
                const amountInput = document.getElementById('amount');
                const paidAmountInput = document.getElementById('paidAmount');
                const dueAmountInput = document.getElementById('dueAmount');

                const amount = parseFloat(amountInput.value);
                const paidAmount = parseFloat(paidAmountInput.value);

                if (!isNaN(amount) && !isNaN(paidAmount)) {
                    const dueAmount = amount - paidAmount;
                    dueAmountInput.value = dueAmount.toFixed(2);
                }

            }
            // Calculate due amount when paid amount is changed
            var editPaidAmountInput = document.getElementById("editPaidAmount");
            var editDueAmountInput = document.getElementById("editDueAmount");
            var editAmountInput = document.getElementById("editAmount");

            editPaidAmountInput.addEventListener("input", function () {
                var paidAmount = parseFloat(editPaidAmountInput.value);
                var totalAmount = parseFloat(editAmountInput.value);
                var dueAmount = totalAmount - paidAmount;
                if (isNaN(dueAmount)) {
                    editDueAmountInput.value = "";
                } else {
                    editDueAmountInput.value = dueAmount.toFixed(2);
                }
            });


            //reload table with reload button 
            function reloadTable() {
    // Show all rows
    const rows = document.querySelectorAll('#expenseTable tbody tr');
    rows.forEach(row => {
        row.style.display = '';
    });

    // Remove "No data found" message if present
    const noDataRow = document.querySelector('#expenseTable tbody tr.no-data-row');
    if (noDataRow) {
        noDataRow.remove();
    }
}

        </script>

    </body>
</html>