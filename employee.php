<?php
// Start the session (assuming the user is already logged in and you've stored the user's name in the session)
require_once 'session.php';

// Include database connection
require_once 'includes/db.php';

// Check the database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch all employees from the database

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

                        <!-- 3 div card code start here -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="card bg-info text-white">
                                        <div class="card-body">
                                            <h5 class="card-title">Total Drivers</h5>
                                            <p class="card-text">
                                                <?php
                    $queryTotalDrivers = "SELECT COUNT(*) AS total_drivers FROM employees WHERE role = 'Driver'";
                    $resultTotalDrivers = mysqli_query($conn, $queryTotalDrivers);
                    $rowTotalDrivers = mysqli_fetch_assoc($resultTotalDrivers);
                    echo $rowTotalDrivers['total_drivers'];
                    ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-success text-white">
                                        <div class="card-body">
                                            <h5 class="card-title">Total Helpers</h5>
                                            <p class="card-text">
                                                <?php
                    $queryTotalHelpers = "SELECT COUNT(*) AS total_helpers FROM employees WHERE role = 'Helper'";
                    $resultTotalHelpers = mysqli_query($conn, $queryTotalHelpers);
                    $rowTotalHelpers = mysqli_fetch_assoc($resultTotalHelpers);
                    echo $rowTotalHelpers['total_helpers'];
                    ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-warning text-white">
                                        <div class="card-body">
                                            <h5 class="card-title">Total Salary</h5>
                                            <p class="card-text">
                                                <i class="fa-solid fa-bangladeshi-taka-sign"></i>
                                                <?php
    $queryTotalSalary = "SELECT SUM(salary) AS total_salary FROM employees";
    $resultTotalSalary = mysqli_query($conn, $queryTotalSalary);
    $rowTotalSalary = mysqli_fetch_assoc($resultTotalSalary);
    echo number_format($rowTotalSalary['total_salary'], 2); // Add number_format function
    ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3 div card code end here -->

                        <!-- Vertically Centered Modal -->

                        <!-- add Modal -->
                        <div class="modal fade" id="employeeAddModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form action="includes/addemployee.php" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="employeeAddModalTitle">Add Employees</h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="nameWithTitle" class="form-label">Full Name</label>
                                                    <input
                                                        type="text"
                                                        id="nameWithTitle"
                                                        name="full_name"
                                                        class="form-control"
                                                        placeholder="Enter Name"/>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="phoneWithTitle" class="form-label">Phone Number</label>
                                                    <input
                                                        type="text"
                                                        id="phoneWithTitle"
                                                        name="phone_number"
                                                        class="form-control"
                                                        placeholder="Enter Phone Number"/>
                                                </div>
                                            </div>

                                            <div class="row g-2">
                                                <div class="col mb-3">
                                                    <label for="nidWithTitle" class="form-label">NID/Licence No</label>
                                                    <input
                                                        type="text"
                                                        id="nidWithTitle"
                                                        name="nid_licence_no"
                                                        class="form-control"
                                                        placeholder="Enter NID/Licence No"/>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="joiningWithTitle" class="form-label">Joining Date</label>
                                                    <input
                                                        type="text"
                                                        id="joiningWithTitle"
                                                        name="joining_date"
                                                        class="form-control"
                                                        placeholder="DD / MM / YY"
                                                        data-date-type="html5-date-input"/>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-3">
                                                    <label for="roleWithTitle" class="form-label">Role</label>
                                                    <select id="roleWithTitle" name="role" class="form-select">

                                                        <option value="Driver">Driver</option>
                                                        <option value="Helper">Helper</option>
                                                    </select>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="salaryWithTitle" class="form-label">Salary</label>
                                                    <input
                                                        type="text"
                                                        id="salaryWithTitle"
                                                        name="salary"
                                                        class="form-control"
                                                        placeholder="Enter Salary"/>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-3">
                                                    <label for="assignedVehiclesWithTitle" class="form-label">Assigned Vehicles</label>
                                                    <select
                                                        id="assignedVehiclesWithTitle"
                                                        name="assigned_vehicle"
                                                        class="form-select">
                                                        <?php
                                                    // Fetch assigned vehicles from the database
                                                    $query = "SELECT vehicle_number FROM vehicles";
                                                    $result = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '<option value="' . $row['vehicle_number'] . '">' . $row['vehicle_number'] . '</option>';
                                                    }
                                                    ?>
                                                    </select>
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

                        <!--edit Modal -->
                        <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form action="includes/editemployee.php" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalTitle">Edit Employee</h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Hidden input field to store the employee ID -->
                                            <input type="hidden" id="edit_employee_id" name="employee_id">

                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="edit_full_name" class="form-label">Full Name</label>
                                                    <input
                                                        type="text"
                                                        id="edit_full_name"
                                                        name="full_name"
                                                        class="form-control"
                                                        placeholder="Enter Name"/>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="edit_phone_number" class="form-label">Phone Number</label>
                                                    <input
                                                        type="text"
                                                        id="edit_phone_number"
                                                        name="phone_number"
                                                        class="form-control"
                                                        placeholder="Enter Phone Number"/>
                                                </div>
                                            </div>

                                            <div class="row g-2">
                                                <div class="col mb-3">
                                                    <label for="edit_nid_licence_no" class="form-label">NID/Licence No</label>
                                                    <input
                                                        type="text"
                                                        id="edit_nid_licence_no"
                                                        name="nid_licence_no"
                                                        class="form-control"
                                                        placeholder="Enter NID/Licence No"/>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="edit_joining_date" class="form-label">Joining Date</label>
                                                    <input
                                                        type="text"
                                                        id="edit_joining_date"
                                                        name="joining_date"
                                                        class="form-control datepicker"
                                                        placeholder="DD / MM / YY"/>
                                                </div>

                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-3">
                                                    <label for="edit_role" class="form-label">Role</label>
                                                    <select id="edit_role" name="role" class="form-select">
                                                        <option value="Driver">Driver</option>
                                                        <option value="Helper">Helper</option>
                                                    </select>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="edit_salary" class="form-label">Salary</label>
                                                    <input
                                                        type="text"
                                                        id="edit_salary"
                                                        name="salary"
                                                        class="form-control"
                                                        placeholder="Enter Salary"/>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-3">
                                                    <label for="edit_assigned_vehicle" class="form-label">Assigned Vehicles</label>
                                                    <select id="edit_assigned_vehicle" name="assigned_vehicle" class="form-select">
                                                        <?php
                                // Fetch assigned vehicles from the database
                                $query = "SELECT vehicle_number FROM vehicles";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['vehicle_number'] . '">' . $row['vehicle_number'] . '</option>';
                                }
                                ?>
                                                    </select>
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

                        <!-- / Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <!-- Table codes start here -->

                            <!-- add employee button here -->

                            <!-- Button trigger modal -->
                            <div class="row">
                                <div class="col-md-3">
                                    <button
                                        type="button"
                                        class="btn rounded-pill btn-outline-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#employeeAddModal">
                                        <i class="fa-solid fa-person-military-to-person"></i>
                                        Add Employee</button>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
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

                                <h5 class="card-header">All Employees</h5>
                                <div class="card-body">
                                    <div class="table-responsive text-nowrap ">
                                        <table
                                            class="table table-bordered text-nowrap table-hover table-striped text-center"
                                            id="vehiclesTable">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Name</th>
                                                    <th>Phone No</th>
                                                    <th>Nid/Licence No</th>
                                                    <th>Joining Date</th>
                                                    <th>Role</th>
                                                    <th>Salary</th>
                                                    <th>Assigned Vehicle</th>
                                                    <th>Actions</th>

                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php $query = "SELECT * FROM employees";
$result = mysqli_query($conn, $query);
$serialNumber = 1;
// Check if the query executed successfully
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($result)) : ?>
                                                <tr>
                                                    <td><?php echo $serialNumber++; ?></td>
                                                    <td><?php echo $row['full_name']; ?></td>
                                                    <td><?php echo $row['phone_number']; ?></td>
                                                    <td><?php echo $row['nid_licence_no']; ?></td>
                                                    <td><?php echo $row['joining_date']; ?></td>
                                                    <td><?php echo $row['role']; ?></td>
                                                    <td><?php echo number_format($row['salary'], 2); ?></td>
                                                    <td><?php echo $row['assigned_vehicle']; ?></td>
                                                    <td>
                                                        <button
                                                            type="button"
                                                            class="btn btn-sm rounded-pill btn-outline-info"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editEmployeeModal"
                                                            onclick="openEditModal(<?php echo $row['id']; ?>, '<?php echo $row['full_name']; ?>', '<?php echo $row['phone_number']; ?>', '<?php echo $row['nid_licence_no']; ?>', '<?php echo $row['joining_date']; ?>', '<?php echo $row['role']; ?>', '<?php echo $row['salary']; ?>', '<?php echo $row['assigned_vehicle']; ?>')">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </button>
                                                        <a
                                                            href="includes/deleteemployee.php?id=<?php echo $row['id']; ?>"
                                                            class="btn rounded-pill btn-sm btn-outline-danger"
                                                            onclick="return confirm('Are you sure you want to delete this employee?')">
                                                            <i class="fa-solid fa-trash"></i>
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

            // Additional code to specifically initialize the HTML5 date
            $(document).ready(function () {
                $('input[data-date-type="html5-date-input"]').attr('type', 'date');
            });

            function searchTable() {
                var input,
                    filter,
                    table,
                    tr,
                    td,
                    i,
                    j,
                    txtValue;
                input = document.getElementById("table_search");
                filter = input
                    .value
                    .toUpperCase();
                table = document.getElementById("vehiclesTable");
                tr = table.getElementsByTagName("tr");

                for (i = 0; i < tr.length; i++) {
                    // Loop through each column (td) within the row (tr)
                    for (j = 1; j < tr[i].cells.length - 1; j++) {
                        td = tr[i].getElementsByTagName("td")[j];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                                break; // Show the row if any column matches the filter nh
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }
            }

            function openEditModal(
                id,
                full_name,
                phone_number,
                nid_licence_no,
                joining_date,
                role,
                salary,
                assigned_vehicle
            ) {
                // Update the modal form with the selected employee data
                document
                    .getElementById("editModalTitle")
                    .innerHTML = "Edit Employee - " + full_name;
                document
                    .getElementById("edit_employee_id")
                    .value = id;
                document
                    .getElementById("edit_full_name")
                    .value = full_name;
                document
                    .getElementById("edit_phone_number")
                    .value = phone_number;
                document
                    .getElementById("edit_nid_licence_no")
                    .value = nid_licence_no; // Set NID/LICENCE NO field
                document
                    .getElementById("edit_joining_date")
                    .value = joining_date; // Set JOINING DATE field
                document
                    .getElementById("edit_role")
                    .value = role;
                document
                    .getElementById("edit_salary")
                    .value = salary;
                document
                    .getElementById("edit_assigned_vehicle")
                    .value = assigned_vehicle;

                // Show the modal
                var modal = new bootstrap.Modal(document.getElementById('employeeEditModal'));
                modal.show();
            }
        </script>

    </body>
</html>