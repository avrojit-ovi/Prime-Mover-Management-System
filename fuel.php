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

        <title>Dashboard - Prime Mover Management System</title>

        <meta name="description" content=""/>

        <?php require_once "includes/css.php"; ?>
        <script>
            const vehicleDriverMap = <?php echo json_encode($vehicleDriverMap); ?>;
        </script>
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
<!-- 4 card codes start here  -->
<div class="container-xxl flex-grow-1 container-p-y">
<div class="row mb-3">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">First 15 days calculation</h5>
                <p class="card-text">
                    <?php
                        // Calculate total FUEL LITER and total taka for the first 15 days of the current month
                        $currentMonth = date('m');
                        $queryFirst15Days = "SELECT SUM(fuel_liter) AS total_fuel_liter, SUM(fuel_liter * fuel_rate) AS total_taka, MONTHNAME(fuel_date) AS month_name
                                            FROM fuel_record
                                            WHERE MONTH(fuel_date) = $currentMonth AND DAY(fuel_date) <= 15";
                        $resultFirst15Days = mysqli_query($conn, $queryFirst15Days);
                        $rowFirst15Days = mysqli_fetch_assoc($resultFirst15Days);
                        echo "Month: " . $rowFirst15Days['month_name'] . "<br>";
                        echo "TOTAL FUEL LITER: " . $rowFirst15Days['total_fuel_liter'] . " <br> Total Taka: " . number_format($rowFirst15Days['total_taka'], 2, '.', ',');
                    ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Last 15 days calculation</h5>
                <p class="card-text">
                    <?php
                        // Calculate total FUEL LITER and total taka for the last 15 days of the current month
                        $queryLast15Days = "SELECT SUM(fuel_liter) AS total_fuel_liter, SUM(fuel_liter * fuel_rate) AS total_taka, MONTHNAME(fuel_date) AS month_name
                                            FROM fuel_record
                                            WHERE MONTH(fuel_date) = $currentMonth AND DAY(fuel_date) > 15";
                        $resultLast15Days = mysqli_query($conn, $queryLast15Days);
                        $rowLast15Days = mysqli_fetch_assoc($resultLast15Days);
                        echo "Month: " . $rowLast15Days['month_name'] . "<br>";
                        echo "TOTAL FUEL LITER: " . $rowLast15Days['total_fuel_liter'] . " <br> Total Taka: " . number_format($rowLast15Days['total_taka'], 2, '.', ',');
                    ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Current Month calculation</h5>
                <p class="card-text">
                    <?php
                        // Calculate total FUEL LITER and total taka for the entire current month
                        $queryCurrentMonth = "SELECT SUM(fuel_liter) AS total_fuel_liter, SUM(fuel_liter * fuel_rate) AS total_taka, MONTHNAME(fuel_date) AS month_name
                                              FROM fuel_record
                                              WHERE MONTH(fuel_date) = $currentMonth";
                        $resultCurrentMonth = mysqli_query($conn, $queryCurrentMonth);
                        $rowCurrentMonth = mysqli_fetch_assoc($resultCurrentMonth);
                        echo "Month: " . $rowCurrentMonth['month_name'] . "<br>";
                        echo "TOTAL FUEL LITER: " . $rowCurrentMonth['total_fuel_liter'] . " <br> Total Taka: " . number_format($rowCurrentMonth['total_taka'], 2, '.', ',');
                    ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Past Month calculation</h5>
                <p class="card-text">
                    <?php
                        // Calculate total FUEL LITER and total taka for the previous month
                        $previousMonth = date('m', strtotime('-1 month'));
                        $queryPreviousMonth = "SELECT SUM(fuel_liter) AS total_fuel_liter, SUM(fuel_liter * fuel_rate) AS total_taka, MONTHNAME(fuel_date) AS month_name
                                               FROM fuel_record
                                               WHERE MONTH(fuel_date) = $previousMonth";
                        $resultPreviousMonth = mysqli_query($conn, $queryPreviousMonth);
                        $rowPreviousMonth = mysqli_fetch_assoc($resultPreviousMonth);
                        echo "Month: " . $rowPreviousMonth['month_name'] . "<br>";
                        echo "TOTAL FUEL LITER: " . $rowPreviousMonth['total_fuel_liter'] . " <br> Total Taka: " . number_format($rowPreviousMonth['total_taka'], 2, '.', ',');
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>
</div>

<!-- 4 card codes end here  -->
                        <!-- add fuel record Modal -->
                        <div class="modal fade" id="fuelAddModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form action="includes/addfuelrecord.php" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="fuelAddModalTitle">Add Fuel Record</h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="vehicleNo" class="form-label">Vehicle No</label>
                                                    <select id="vehicleNo" name="vehicle_number" class="form-select" required>
                                                        <option value="" selected disabled>---- Please Select----</option>
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
                                                    <label for="fuelLiter" class="form-label">Fuel Liter</label>
                                                    <input
                                                        type="text"
                                                        id="fuelLiter"
                                                        name="fuel_liter"
                                                        class="form-control"
                                                        placeholder="Enter Fuel Liter" required/>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="fuelRate" class="form-label">Fuel Rate</label>
                                                    <?php
                    // Fetch fuel rate from the database
                    $queryFuelRate = "SELECT fuel_rate FROM fuel_rate WHERE id = 1";
                    $resultFuelRate = mysqli_query($conn, $queryFuelRate);
                    $rowFuelRate = mysqli_fetch_assoc($resultFuelRate);
                    ?>
                                                    <input
                                                        type="text"
                                                        id="fuelRate"
                                                        name="fuel_rate"
                                                        class="form-control"
                                                        value="<?php echo $rowFuelRate['fuel_rate']; ?>"
                                                        placeholder="Enter Fuel Rate" />
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="driverName" class="form-label">Driver Name</label>
                                                    <select id="driverName" name="driver_name" class="form-select" required>
                                                        <option value="" selected disabled>Please select</option>
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
                                            </div>
                                            <div class="row g-2">
                                                <div class="col mb-3">
                                                    <label for="fuelDate" class="form-label">Fuel Date</label>
                                                    <input
                                                        type="date"
                                                        id="fuelDate"
                                                        name="fuel_date"
                                                        class="form-control"
                                                        value="<?php echo date('Y-m-d'); ?>"
                                                        placeholder="Select Fuel Date"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn rounded-pill btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn rounded-pill btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /add fuel record Modal -->

                        <!-- Edit fuel record Modal -->
                        <div class="modal fade" id="editfuelrcdModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form action="includes/editfuelrecord.php" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Fuel Record</h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" id="editFuelId" name="fuel_id">
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label for="editVehicleNo" class="form-label">Vehicle No</label>
                                                    <select id="editVehicleNo" name="edit_vehicle_number" class="form-select">
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
                                                    <label for="editFuelLiter" class="form-label">Fuel Liter</label>
                                                    <input
                                                        type="text"
                                                        id="editFuelLiter"
                                                        name="edit_fuel_liter"
                                                        class="form-control"
                                                        placeholder="Enter Fuel Liter"/>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="editFuelRate" class="form-label">Fuel Rate</label>
                                                    <input
                                                        type="text"
                                                        id="editFuelRate"
                                                        name="edit_fuel_rate"
                                                        class="form-control"
                                                        placeholder="Enter Fuel Rate"/>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="editDriverName" class="form-label">Driver Name</label>
                                                    <select id="editDriverName" name="edit_driver_name" class="form-select">
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
                                            </div>
                                            <div class="row g-2">
                                                <div class="mb-3">
                                                    <label for="editFuelDate" class="form-label">Fuel Date</label>
                                                    <input
                                                        type="date"
                                                        id="editFuelDate"
                                                        name="edit_fuel_date"
                                                        class="form-control"
                                                        placeholder="Select Fuel Date"/>
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
                        <!-- /Edit fuel record Modal -->

                        <!-- Vertically Centered Modal -->

                        <!-- add Modal -->

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
                                        data-bs-target="#fuelAddModal">
                                        <i class="fa-solid fa-gas-pump"></i>
                                        Add Fuel Record</button>
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
                                            <button class="btn rounded-pill btn-outline-primary" onclick="applyDateFilter()">Apply Date Filter</button>
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

                                <h5 class="card-header">Fuel Record</h5>
                                <div class="card-body">
                                    <div class="table-responsive text-nowrap ">
                                        <table
                                            class="table table-bordered text-nowrap table-hover table-striped text-center"
                                            id="vehiclesTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Vehicle No</th>
                                                    <th>Fuel Liter</th>
                                                    <th>Fuel Rate</th>
                                                    <th>Total Taka</th>
                                                    <th>Driver Name</th>
                                                    <th>Fuel Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php
    // Fetch fuel records from the database
    $queryFuelRecords = "SELECT * FROM fuel_record";
    $resultFuelRecords = mysqli_query($conn, $queryFuelRecords);
    $serialNumber = 1;
    while ($rowFuelRecord = mysqli_fetch_assoc($resultFuelRecords)) {

        // Calculate the total taka
        $totalTaka = $rowFuelRecord['fuel_liter'] * $rowFuelRecord['fuel_rate'];

        ?>
                                                <tr>
                                                    <td><?php echo $serialNumber++; ?></td>
                                                    <td><?php echo $rowFuelRecord['vehicle_number']?></td>
                                                    <td><?php echo $rowFuelRecord['fuel_liter']?></td>
                                                    <td><?php echo $rowFuelRecord['fuel_rate']?></td>
                                                    <td><?php echo number_format($totalTaka, 2, '.', ','); ?></td>
                                                    <!-- Display total taka here -->
                                                    <td><?php echo $rowFuelRecord['driver_name']?></td>
                                                    <td><?php echo $rowFuelRecord['fuel_date']?></td>
                                                    <td>
                                                        <button
                                                            type="button"
                                                            class="btn rounded-pill btn-sm btn-outline-info"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editfuelrcdModal"
                                                            onclick="openEditModal(<?php echo $rowFuelRecord['id']; ?>, '<?php echo $rowFuelRecord['vehicle_number']; ?>', '<?php echo $rowFuelRecord['fuel_liter']; ?>', '<?php echo $rowFuelRecord['fuel_rate']; ?>', '<?php echo $rowFuelRecord['driver_name']; ?>', '<?php echo $rowFuelRecord['fuel_date']; ?>')">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </button>
                                                        <a
                                                            href="includes/deletefuelrcd.php?id=<?php echo $rowFuelRecord['id']; ?>"
                                                            class="btn rounded-pill btn-sm btn-outline-danger"
                                                            onclick="return confirm('Are you sure you want to delete this fuel record?')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php }
    ?>
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
            // Function to open and populate the edit modal
            function openEditModal(
                id,
                vehicleNumber,
                fuelLiter,
                fuelRate,
                driverName,
                fuelDate
            ) {

                // Populate the input fields in the edit modal
                document
                    .getElementById('editFuelId')
                    .value = id;
                document
                    .getElementById('editVehicleNo')
                    .value = vehicleNumber;
                document
                    .getElementById('editFuelLiter')
                    .value = fuelLiter;
                document
                    .getElementById('editFuelRate')
                    .value = fuelRate;
                document
                    .getElementById('editDriverName')
                    .value = driverName;
                document
                    .getElementById('editFuelDate')
                    .value = fuelDate;

                // Show the edit modal
                $('#editfuelrcdModal').modal('show');
            }

            function applyDateFilter() {
                const fromDate = document
                    .getElementById('fromDate')
                    .value;
                const toDate = document
                    .getElementById('toDate')
                    .value;

                // Fetch the table rows
                const rows = document.querySelectorAll('#vehiclesTable tbody tr');

                // Loop through the rows and show/hide based on the date filter
                for (const row of rows) {
                    const fuelDate = row
                        .querySelector('td:nth-child(7)')
                        .textContent; // Adjust the index if needed
                    if (fromDate && fuelDate < fromDate) {
                        row.style.display = 'none';
                    } else if (toDate && fuelDate > toDate) {
                        row.style.display = 'none';
                    } else {
                        row.style.display = '';
                    }
                }
            }
            // search box javascript code here

            function searchTable() {
    const searchValue = document.getElementById('table_search').value.toLowerCase();
    const table = document.getElementById('vehiclesTable');
    const rows = table.getElementsByTagName('tr');
    
    // Iterate through each row
    for (let i = 1; i < rows.length; i++) { // Start from index 1 to exclude the header row
        const row = rows[i];
        const columns = row.getElementsByTagName('td');
        let shouldDisplay = false;

        // Iterate through each cell in the row
        for (let j = 0; j < columns.length; j++) {
            const cell = columns[j];
            const columnText = cell.textContent.toLowerCase();
            
            // Compare cell text with search value
            if (columnText.indexOf(searchValue) > -1) {
                shouldDisplay = true;
                break; // If a match is found, no need to continue checking other cells
            }
        }

        // Display or hide row based on search result
        row.style.display = shouldDisplay ? '' : 'none';
    }
}
        </script>

    </body>
</html>