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


  <!--Expenses 4 divs codes start here  -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Add the following code above the "Button trigger modal" section -->
    <div class="row">
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
            // Calculate total paid and due amounts for the first 15 days of the current month
            $first15DaysAmountQuery = "SELECT SUM(paid_amount) AS total_paid, SUM(due_amount) AS total_due FROM expenses WHERE DAY(expense_date) <= 15 AND MONTH(expense_date) = MONTH(CURRENT_DATE())";
            $first15DaysAmountResult = mysqli_query($conn, $first15DaysAmountQuery);
            $first15DaysAmountData = mysqli_fetch_assoc($first15DaysAmountResult);
            ?>
                                            <p>Total Expenses:
                                                <?php echo $first15DaysExpensesData['total_expenses']; ?></p>
                                            <p>Total Amount:
                                                <?php echo number_format($first15DaysExpensesData['total_amount'],2); ?></p>

                                            <p>Total Paid:
                                                <?php echo "<strong><span class='text-dark'>" . number_format($first15DaysAmountData['total_paid'],2) . "</span></strong>"; ?></p>
                                            <p>Total Due:
                                                <?php echo "<strong><span class='text-danger'>" . number_format($first15DaysAmountData['total_due'],2) . "</span></strong>"; ?></p>
                                            <p>Month:
                                                <?php echo date('F'); ?></p>
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
             // Calculate total paid and due amounts for the last 15 days of the current month
             $last15DaysAmountQuery = "SELECT SUM(paid_amount) AS total_paid, SUM(due_amount) AS total_due FROM expenses WHERE DAY(expense_date) > 15 AND MONTH(expense_date) = MONTH(CURRENT_DATE())";
             $last15DaysAmountResult = mysqli_query($conn, $last15DaysAmountQuery);
             $last15DaysAmountData = mysqli_fetch_assoc($last15DaysAmountResult);
            ?>
                                            <p>Total Expenses:
                                                <?php echo $last15DaysExpensesData['total_expenses']; ?></p>
                                            <p>Total Amount:
                                                <?php echo number_format($last15DaysExpensesData['total_amount'],2); ?></p>
                                               
                                        <p>Total Paid:
                                            <?php echo "<strong><span class='text-dark'>" . number_format($last15DaysAmountData['total_paid'],2) . "</span></strong>"; ?></p>
                                        <p>Total Due:
                                            <?php echo "<strong><span class='text-danger'>" . number_format($last15DaysAmountData['total_due'],2) . "</span></strong>"; ?></p>
                                            <p>Month:
                                                <?php echo date('F'); ?></p>
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
             // Calculate total paid and due amounts for the entire current month
             $currentMonthAmountQuery = "SELECT SUM(paid_amount) AS total_paid, SUM(due_amount) AS total_due FROM expenses WHERE MONTH(expense_date) = MONTH(CURRENT_DATE())";
             $currentMonthAmountResult = mysqli_query($conn, $currentMonthAmountQuery);
             $currentMonthAmountData = mysqli_fetch_assoc($currentMonthAmountResult);
            ?>
                                            <p>Total Expenses:
                                                <?php echo $currentMonthExpensesData['total_expenses']; ?></p>
                                            <p>Total Amount:
                                                <?php echo number_format($currentMonthExpensesData['total_amount'],2); ?></p>
                                             
                                        <p>Total Paid:
                                            <?php echo "<strong><span class='text-dark'>" . number_format($currentMonthAmountData['total_paid'],2) . "</span></strong>"; ?></p>
                                        <p>Total Due:
                                            <?php echo "<strong><span class='text-danger'>" . number_format($currentMonthAmountData['total_due'],2) . "</span></strong>"; ?></p>
                                            <p>Month:
                                                <?php echo date('F'); ?></p>
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
             // Calculate total paid and due amounts for the entire previous month
             $previousMonthAmountQuery = "SELECT SUM(paid_amount) AS total_paid, SUM(due_amount) AS total_due FROM expenses WHERE MONTH(expense_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)";
             $previousMonthAmountResult = mysqli_query($conn, $previousMonthAmountQuery);
             $previousMonthAmountData = mysqli_fetch_assoc($previousMonthAmountResult);
            ?>
                                            <p>Total Expenses:
                                                <?php echo $previousMonthExpensesData['total_expenses']; ?></p>
                                            <p>Total Amount:
                                                <?php echo number_format($previousMonthExpensesData['total_amount'],2); ?></p>
                                                <p>Total Paid:
                                            <?php echo  "<strong><span class='text-dark'>" . $previousMonthAmountData['total_paid'] . "</span></strong>"; ?></p>
                                        <p>Total Due:
                                        <?php echo  "<strong><span class='text-danger'>" . $previousMonthAmountData['total_due'] . "</span></strong>"; ?></p>
                                            <p>Month:
                                                <?php echo date('F', strtotime('-1 month')); ?></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- 4 divs codes end here -->


  <!-- Expenses 4 divs codes end here  -->

      <!-- fuel 4 card codes start here  -->

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
</div>


<!--fuel 4 card codes end here  -->
<?php  include_once 'includes/trip4div.php'      ?>
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
