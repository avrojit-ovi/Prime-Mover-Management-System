                    <!-- 4 div code start here -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <?php    
                        
                        // Get current month and previous month
$currentMonth = date('m');
$previousMonth = date('m', strtotime('last month'));

// Function to calculate summary statistics for a date range
function calculateSummary($startDate, $endDate) {
    global $conn;

    $query = "SELECT COUNT(*) AS tripCount, SUM(amount) AS totalIncome, SUM(driver_allowance) AS totalDriverAllowance, SUM(helper_allowance) AS totalHelperAllowance FROM trip_record WHERE trip_date BETWEEN '$startDate' AND '$endDate'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    return $row;
}

// Calculate summary statistics for different date ranges
$first15DaysCurrentMonth = calculateSummary(date("Y-$currentMonth-01"), date("Y-$currentMonth-15"));
$last15DaysCurrentMonth = calculateSummary(date("Y-$currentMonth-16"), date("Y-$currentMonth-t"));
$fullCurrentMonth = calculateSummary(date("Y-$currentMonth-01"), date("Y-$currentMonth-t"));
$fullPreviousMonth = calculateSummary(date("Y-$previousMonth-01"), date("Y-$previousMonth-t"));

                        
                        ?>
                        <div class="row">
                           
<!-- Card 1: First 15 days of current month -->
<div class="col-md-3">
<div class="card">
    <div class="card-header">
      
       <h5 class="card-title">First 15 days trips</h5>
    </div>
    <div class="card-body">
        <p>Month: <?php echo date('F'); ?></p>
        <p>Total Trip: <?php echo $first15DaysCurrentMonth['tripCount']; ?></p>
        <p>Total Income: <?php echo $first15DaysCurrentMonth['totalIncome']; ?></p>
        <p>Total Driver Allowance: <?php echo $first15DaysCurrentMonth['totalDriverAllowance']; ?></p>
        <p>Total Helper Allowance: <?php echo $first15DaysCurrentMonth['totalHelperAllowance']; ?></p>
    </div>
</div>
</div>

<!-- Card 2: Last 15 days of current month -->
<div class="col-md-3">
<div class="card">
    <div class="card-header">
        
        <h5 class="card-title">Last 15 days trips</h5>
    </div>
    <div class="card-body">
        <p>Month: <?php echo date('F'); ?></p>
        <p>Total Trip: <?php echo $last15DaysCurrentMonth['tripCount']; ?></p>
        <p>Total Income: <?php echo $last15DaysCurrentMonth['totalIncome']; ?></p>
        <p>Total Driver Allowance: <?php echo $last15DaysCurrentMonth['totalDriverAllowance']; ?></p>
        <p>Total Helper Allowance: <?php echo $last15DaysCurrentMonth['totalHelperAllowance']; ?></p>
    </div>
</div>
</div>

<!-- Card 3: Full current month -->
<div class="col-md-3">
<div class="card">
    <div class="card-header">
        
        <h5 class="card-title">Full current month trips</h5>
    </div>
    <div class="card-body">
        <p>Month: <?php echo date('F'); ?></p>
        <p>Total Trip: <?php echo $fullCurrentMonth['tripCount']; ?></p>
        <p>Total Income: <?php echo $fullCurrentMonth['totalIncome']; ?></p>
        <p>Total Driver Allowance: <?php echo $fullCurrentMonth['totalDriverAllowance']; ?></p>
        <p>Total Helper Allowance: <?php echo $fullCurrentMonth['totalHelperAllowance']; ?></p>
    </div>
</div>
</div>

<!-- Card 4: Full previous month -->
<div class="col-md-3">
<div class="card">
    <div class="card-header">
        <h5 class="card-title"> Full previous month trips</h5>
    </div>
    <div class="card-body">
        <p>Month: <?php echo date('F', strtotime('last month')); ?></p>
        <p>Total Trip: <?php echo $fullPreviousMonth['tripCount']; ?></p>
        <p>Total Income: <?php echo $fullPreviousMonth['totalIncome']; ?></p>
        <p>Total Driver Allowance: <?php echo $fullPreviousMonth['totalDriverAllowance']; ?></p>
        <p>Total Helper Allowance: <?php echo $fullPreviousMonth['totalHelperAllowance']; ?></p>
    </div>
</div>
</div>
                    </div>

                            
                    </div>
                    <!-- 4 div code end here  -->