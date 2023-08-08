<?php require_once "session.php" ?>



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
