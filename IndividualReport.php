<?php
define('TITLE', 'Individual Report');
define('PAGE', 'individualreport');
include('includes/header1.php');
include('dbConnection.php');
session_start();

if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='index.php'; </script>";
}
$currentMonth = date("M");
$currentYear = date("Y");
$trs=0;
$pension=0;
$cpension=0;
$SWF = 250;
$sql = "SELECT * FROM employee WHERE Email = '$rEmail' ";
$result = $conn->query($sql);

// Check if a row is returned
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $EmployeeID = $row['EmployeeID'];

    $sql_staff = "SELECT * FROM staff WHERE EmployeeID = '$EmployeeID' ";
    $result_staff = $conn->query($sql_staff);

    // Check if a row is returned
    if ($result_staff->num_rows > 0) {
        $row_staff = $result_staff->fetch_assoc();

        if ($row_staff['PaymentCurrency'] == 'USD') {
            // Your code here
               $sqli = "SELECT * FROM exchange_rate";
               $resulti = $conn->query($sqli);
               if ($resulti->num_rows == 1) {
                 $rowi = $resulti->fetch_assoc();
                 $er = floatval($rowi["ETB"]);
               }
            $row_staff['BasicSalary'] *= $er;
            $row_staff['HousingAllowance'] *= $er;
            $row_staff['OvertimePayment'] *= $er;
            $row_staff['CarAllowance'] *= $er;
            $row_staff['HolydayPay'] *= $er;
            $row_staff['AnualBonus'] *= $er; 
            $row_staff['FCA'] *= $er; 
        }

        $totalRowSum = $row_staff['BasicSalary'] + $row_staff['HousingAllowance'] + $row_staff['OvertimePayment'] + $row_staff['AnualBonus'] + $row_staff['CarAllowance'] + $row_staff['HolydayPay'] + $row_staff['FCA'];
        $trs += $totalRowSum;
        $pension = floatval($row_staff['BasicSalary']) * 0.07;
        $cpension = floatval($row_staff['BasicSalary']) * 0.11;

        if (floatval($row_staff['CarAllowance']) < (floatval($row_staff['BasicSalary']) * 0.25)) {
            $grossSalary = $totalRowSum - floatval($row_staff['CarAllowance']);
        } else {
            $grossSalary = $totalRowSum - (floatval($row_staff['BasicSalary']) * 0.25);
        }


        $taxRate = 0;
        $deduction = 0;
        $pensionRate = 0.07; // Employee pension rate is 7%
        $companyPensionRate = 0.11; // Company pension rate is 11%

        if ($grossSalary >= 0 && $grossSalary <= 600) {
            $taxRate = 0;
            $deduction = 0;
        } elseif ($grossSalary >= 601 && $grossSalary <= 1650) {
            $taxRate = 0.10;
            $deduction = 60;
        } elseif ($grossSalary >= 1651 && $grossSalary <= 3200) {
            $taxRate = 0.15;
            $deduction = 142.50;
        } elseif ($grossSalary >= 3201 && $grossSalary <= 5250) {
            $taxRate = 0.20;
            $deduction = 302.50;
        } elseif ($grossSalary >= 5251 && $grossSalary <= 7800) {
            $taxRate = 0.25;
            $deduction = 565;
        } elseif ($grossSalary >= 7801 && $grossSalary <= 10900) {
            $taxRate = 0.30;
            $deduction = 955;
        } elseif ($grossSalary > 10900) {
            $taxRate = 0.35;
            $deduction = 1500;
        }
        
        $salaryIncomeTax = ($grossSalary * $taxRate) - $deduction;
        if ($row_staff['PaymentCurrency'] == 'USD') {
            $redcrosscontribution = 0;
            $SWF = 0;
            $deduction = $salaryIncomeTax + $pension + $redcrosscontribution + $SWF + floatval($row_staff["Loan"]);
       } else {
            $SWF = 250;
            $redcrosscontribution = floatval($row_staff["BasicSalary"]) * 0.05;
            $deduction = $salaryIncomeTax + $pension + $redcrosscontribution + $SWF + floatval($row_staff["Loan"]);
        }
        $net = $trs - $deduction;
    }
}
?>

<style>
        th, td {
            text-align: right;
        }

        @media (max-width: 767px) {
            th, td {
                text-align: left;
            }
        }
    </style>
    
<div class="container d-print-block mt-8">
<br> <br> <br>
    <div class="bg-dark text-white text-center mt-1">
        <h2><?php echo $row_staff['NameOfStaff']; ?> Payslip for <?php echo $currentMonth . ' - ' . $currentYear; ?></h2><br>      
        <h5 class="text-left">&nbsp;&nbsp;&nbsp;ID : <?php echo $row['EmployeeID']; ?></h5>
        <h5 class="text-left">&nbsp;&nbsp;&nbsp;Name : <?php echo $row_staff['NameOfStaff']; ?></h5>
        <h5 class="text-left">&nbsp;&nbsp;&nbsp;Email : <?php echo $row['Email']; ?></h5>
        <h5 class="text-left">&nbsp;&nbsp;&nbsp;Department : <?php echo $row_staff['Department']; ?></h5>
        <br>
    </div> 
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-center">Earnings</h4>
            <table class="table table-bordered bg-light">
                    <tr>
                        <th>Basic Salary</th>
                        <th><?php echo number_format(floatval($row_staff['BasicSalary']), 2); ?></th>
                    </tr>
                    <tr>
                        <th>Housing Allowance</th>
                        <th><?php echo number_format(floatval($row_staff['HousingAllowance']), 2); ?></th>
                    </tr>
                    <tr>
                        <th>Overtime Payment</th>
                        <th><?php echo number_format(floatval($row_staff['OvertimePayment']), 2); ?></th>
                    </tr>
                    <tr>
                        <th>Car Allowance</th>
                        <th><?php echo number_format(floatval($row_staff['CarAllowance']), 2); ?></th>
                    </tr>
                    <tr>
                        <th>Anual Bonus</th>
                        <th><?php echo number_format(floatval($row_staff['AnualBonus']), 2); ?></th>
                    </tr>
                    <tr>
                        <th>Holiday Pay</th>
                        <th><?php echo number_format(floatval($row_staff['HolydayPay']), 2); ?></th>
                    </tr>
                    <tr>
                        <th>Total Earnings</th>
                        <th><?php echo number_format(floatval($trs), 2); ?></th>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h4 class="text-center">Deductions</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Income Tax</th>
                        <th><?php echo number_format(floatval($salaryIncomeTax), 2); ?></th>
                    </tr>
                    <tr>
                        <th>Pension (Employee)</th>
                        <th><?php echo number_format(floatval($pension), 2); ?></th>
                    </tr>
                    <tr>
                        <th>Social Walefare</th>
                        <th><?php echo number_format(floatval($SWF), 2); ?></th>
                    </tr>
                    <tr>
                        <th>Red Cross Contribution</th>
                        <th><?php echo number_format(floatval($redcrosscontribution), 2); ?></th>
                    </tr>
                    <tr>
                        <th>Outstanding Loan</th>
                        <th><?php echo number_format(floatval($row_staff["Loan"]), 2); ?></th>
                    </tr>
                    <tr>
                        <th>Total Deductions</th>
                        <th><?php echo number_format(floatval($deduction), 2); ?></th>
                    </tr>
                </table>
            </div>
        </div>
    <h4 class="text-center">Net Pay: <?php echo number_format(floatval($net), 2);?></h4> <br>     
    <form class="d-print-none d-flex justify-content-center">
    <input class="btn btn-danger" type="submit" value="Print" onClick="window.print()">
</form>

</div>

<?php
include('includes/footer.php');
?>