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
  <!-- 4 divs codes start here  -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Add the following code above the "Button trigger modal" section -->


<div class="row mb-3">

<!-- First 15 days Expense -->
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">First 15 days Expense</h5>
            <?php
            // Calculate total expenses and amount for the first 15 days of the current month
            $first15DaysExpensesQuery = "SELECT COUNT(id) AS total_expenses, SUM(amount) AS total_amount FROM expenses WHERE DAY(expense_date) <= 15 AND MONTH(expense_date) = MONTH(CURRENT_DATE())";
            $first15DaysExpensesResult = mysqli_query($conn, $first15DaysExpensesQuery);
            $first15DaysExpensesData = mysqli_fetch_assoc($first15DaysExpensesResult);
            ?>
            <p>Total Expenses: <?php echo $first15DaysExpensesData['total_expenses']; ?></p>
            <p>Total Amount: <?php echo $first15DaysExpensesData['total_amount']; ?></p>
            <p>Month: <?php echo date('F'); ?></p>
        </div>
    </div>
</div>

<!-- Last 15 days Expense -->
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Last 15 days Expense</h5>
            <?php
            // Calculate total expenses and amount for the last 15 days of the current month
            $last15DaysExpensesQuery = "SELECT COUNT(id) AS total_expenses, SUM(amount) AS total_amount FROM expenses WHERE DAY(expense_date) > 15 AND MONTH(expense_date) = MONTH(CURRENT_DATE())";
            $last15DaysExpensesResult = mysqli_query($conn, $last15DaysExpensesQuery);
            $last15DaysExpensesData = mysqli_fetch_assoc($last15DaysExpensesResult);
            ?>
            <p>Total Expenses: <?php echo $last15DaysExpensesData['total_expenses']; ?></p>
            <p>Total Amount: <?php echo $last15DaysExpensesData['total_amount']; ?></p>
            <p>Month: <?php echo date('F'); ?></p>
        </div>
    </div>
</div>

<!-- Current Month Expense -->
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Current Month Expense</h5>
            <?php
            // Calculate total expenses and amount for the entire current month
            $currentMonthExpensesQuery = "SELECT COUNT(id) AS total_expenses, SUM(amount) AS total_amount FROM expenses WHERE MONTH(expense_date) = MONTH(CURRENT_DATE())";
            $currentMonthExpensesResult = mysqli_query($conn, $currentMonthExpensesQuery);
            $currentMonthExpensesData = mysqli_fetch_assoc($currentMonthExpensesResult);
            ?>
            <p>Total Expenses: <?php echo $currentMonthExpensesData['total_expenses']; ?></p>
            <p>Total Amount: <?php echo $currentMonthExpensesData['total_amount']; ?></p>
            <p>Month: <?php echo date('F'); ?></p>
        </div>
    </div>
</div>

<!-- Previous Month Expense -->
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Previous Month Expense</h5>
            <?php
            // Calculate total expenses and amount for the entire previous month
            $previousMonthExpensesQuery = "SELECT COUNT(id) AS total_expenses, SUM(amount) AS total_amount FROM expenses WHERE MONTH(expense_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)";
            $previousMonthExpensesResult = mysqli_query($conn, $previousMonthExpensesQuery);
            $previousMonthExpensesData = mysqli_fetch_assoc($previousMonthExpensesResult);
            ?>
            <p>Total Expenses: <?php echo $previousMonthExpensesData['total_expenses']; ?></p>
            <p>Total Amount: <?php echo $previousMonthExpensesData['total_amount']; ?></p>
            <p>Month: <?php echo date('F', strtotime('-1 month')); ?></p>
        </div>
    </div>
</div>


  </div>
  </div>
  <!-- 4 divs codes end here  -->


                     <!-- add expense modal code start here -->
                     
<div class="modal fade" id="addExpenseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="includes/addexpense.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addExpenseModalTitle">Add Expense Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-md-6 mb-3">
                            <label for="expenseName" class="form-label">Expense Name</label>
                            <input type="text" id="expenseName" name="expense_name" class="form-control" placeholder="Enter Expense Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter Amount" required>
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
                            <input type="date" id="expenseDate" name="expense_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
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
<!-- / Add Expense Modal -->
                     <!--  add expense modal code end here-->
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
                    </div>
                    <div class="row g-2">
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
                                        <button class="btn btn-outline-primary" type="button" onclick="searchTable()">Search</button>

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
                                                    <th>Amount</th>
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

                            <td><?php echo $rowExpense['amount']; ?></td>
                            <td><?php echo $rowExpense['vehicle_number']; ?></td>
                            <td><?php echo $rowExpense['expense_date']; ?></td>
                            <td>
                            <button
    type="button"
    class="btn btn-sm btn-info edit-button"
    data-bs-toggle="modal"
    data-bs-target="#editExpenseModal"
    data-id="<?php echo $rowExpense['id']; ?>"
    data-name="<?php echo $rowExpense['expense_name']; ?>"
    data-amount="<?php echo $rowExpense['amount']; ?>"
    data-vehicle="<?php echo $rowExpense['vehicle_number']; ?>"
    data-date="<?php echo $rowExpense['expense_date']; ?>">
    <i class="fa-regular fa-pen-to-square"></i>
</button>
<a href="includes/deleteExpense.php?id=<?php echo $rowExpense['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this expense record?')">
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
            var vehicle = button.getAttribute("data-vehicle");
            var date = button.getAttribute("data-date");

            document.getElementById("editExpenseId").value = id;
            document.getElementById("editExpenseName").value = name;
            document.getElementById("editAmount").value = amount;
            document.getElementById("editVehicleNumber").value = vehicle;
            document.getElementById("editExpenseDate").value = date;
        });
    });
});


// date filter code 
function applyDateFilter() {
    const fromDate = document.getElementById('fromDate').value;
    const toDate = document.getElementById('toDate').value;

    const rows = document.querySelectorAll('#expenseTable tbody tr');

    rows.forEach(row => {
        const expenseDate = row.querySelector('td:nth-child(5)').textContent; // Adjust the index if needed
        if (fromDate && expenseDate < fromDate) {
            row.style.display = 'none';
        } else if (toDate && expenseDate > toDate) {
            row.style.display = 'none';
        } else {
            row.style.display = '';
        }
    });
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

</script>


    </body>
</html>