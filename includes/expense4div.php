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