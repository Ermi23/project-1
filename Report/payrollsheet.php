<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
         
<?php

$currentMonth = date("M");
$currentYear = date("Y");

// Fetch data from MySQL
//$sql = "SELECT * FROM payroll_sheet WHERE Datee = '$currentMonth - $currentYear'";
$query = "SELECT * FROM payroll_sheet WHERE Datee = '" . $currentMonth . ' - ' . $currentYear . "'";

$results = $conn->query($query);

if ($results->num_rows > 0) {
    $data = array();

    // Fetch data and add to the array
    while ($rows = $results->fetch_assoc()) {
        $data[] = $rows;
    }
} 
            $Month = $_REQUEST['Month'];
            $Year = $_REQUEST['Year'];
            $reporttype = $_REQUEST['reporttype'];
            $sql = "SELECT * FROM staff ";
            $result = $conn->query($sql);
            $trs=0;
            $totalICT = 0;
            $totalPEN = 0;
            $totalgrossSalary = 0;
            $totalRCC = 0;
            $totalSWF=0;
            $SWF = 250;
            $totalDeduction = 0;
            $totalNet = 0;
            $tgs=0;
            $tloan = null;
            
            if ($result->num_rows > 0) {
                echo '
                <h3 class=" bg-danger text-white p-2 mt-4 print-section">Payroll Sheet Report For '. $Month .' - '. $Year .'</h3>
                <table class="table print-section">
                    <thead>
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Basic Salary</th>
                            <th scope="col">Housing Allowance</th>
                            <th scope="col">Overtmie Payment</th>
                            <th scope="col">Anual Bonus</th>
                            <th scope="col">Car Allowance</th>
                            <th scope="col">Holyday Pay</th>
                            <th scope="col">Total Income</th>
                            <th scope="col">Taxable Income</th>
                            <th scope="col">Income Tax</th>
                            <th scope="col">Pension</th>
                            <th scope="col">Red Cross Contribution</th>
                            <th scope="col">Social Welfare Contribution</th>
                            <th scope="col">Loan Deduction</th>
                            <th scope="col">Total Deduction</th>
                            <th scope="col">Net Pay</th>
                        </tr>
                    </thead>
                    <tbody>';

                while ($row = $result->fetch_assoc()) {
                    $a = $row["EmployeeID"];

                    // $sqlsumrow = "SELECT BasicSalary, HousingAllowance, OvertimePayment, AnualBonus, CarAllowance, HolydayPay, PaymentCurrency, FCA FROM staff WHERE EmployeeID = '$a'";
                    // $resultSum = $conn->query($sqlsumrow);
                    // $rowSum = $resultSum->fetch_assoc();

                    $sqli = "SELECT * FROM exchange_rate";
                    $resulti = $conn->query($sqli);
                    if ($resulti->num_rows == 1) {
                      $rowi = $resulti->fetch_assoc();
                      $er = floatval($rowi["ETB"]);
                    }

                    if ($row['PaymentCurrency'] == 'USD') {
                        // Your code here
                        $row['BasicSalary'] *= $er;
                        $row['HousingAllowance'] *= $er;
                        $row['OvertimePayment'] *= $er;
                        $row['CarAllowance'] *= $er;
                        $row['HolydayPay'] *= $er;
                        $row['AnualBonus'] *= $er;  
                        $row['FCA'] *= $er; 
                    }

                    $totalRowSum = $row['BasicSalary'] + $row['HousingAllowance'] + $row['OvertimePayment'] + $row['AnualBonus'] + $row['CarAllowance'] + $row['HolydayPay'] + $row['FCA'];
                    $trs += $totalRowSum;
                    
                        if($row['CarAllowance'] < ($row['BasicSalary'] * 0.25) ) {
                            $grossSalary = $totalRowSum - $row['CarAllowance'];
                        }
                        else{
                            $grossSalary =  $totalRowSum - ( $row['BasicSalary'] * 0.25 );
                        }


                        $taxRate = 0;
                        $deductionn = 0;
                        $deduction = 0;
                        $pensionRate = 0.07; // Employee pension rate is 7%
                        $companyPensionRate = 0.11; // Company pension rate is 11%
                
                        if ($grossSalary >= 0 && $grossSalary <= 600) {
                            $taxRate = 0;
                            $deductionn = 0;
                        } elseif ($grossSalary >= 601 && $grossSalary <= 1650) {
                            $taxRate = 0.10;
                            $deductionn = 60;
                        } elseif ($grossSalary >= 1651 && $grossSalary <= 3200) {
                            $taxRate = 0.15;
                            $deductionn = 142.50;
                        } elseif ($grossSalary >= 3201 && $grossSalary <= 5250) {
                            $taxRate = 0.20;
                            $deductionn = 302.50;
                        } elseif ($grossSalary >= 5251 && $grossSalary <= 7800) {
                            $taxRate = 0.25;
                            $deductionn = 565;
                        } elseif ($grossSalary >= 7801 && $grossSalary <= 10900) {
                            $taxRate = 0.30;
                            $deductionn = 955;
                        } elseif ($grossSalary > 10900) {
                            $taxRate = 0.35;
                            $deductionn = 1500;
                        }
                
                        $employeePension = $row["BasicSalary"] * $pensionRate;
                        $salaryIncomeTax = ($grossSalary * $taxRate) - $deductionn;
                        $companyPension = $row["BasicSalary"] * $companyPensionRate;
                        $otherTaxes = 0; // Add other taxes here if applicable
                        
                        if ($row['PaymentCurrency'] == 'USD') {
                            $redcrosscontribution = 0;
                            $SWF = 0;
                            $deduction = $salaryIncomeTax + $employeePension + $redcrosscontribution + $SWF + $row["Loan"];  
                        }
                        else {
                            $SWF = 250;
                        $redcrosscontribution = $row["BasicSalary"] * 0.05; 
                        $deduction = $salaryIncomeTax + $employeePension + $redcrosscontribution + $SWF + $row["Loan"];
                        }

                        $netSalary = $grossSalary - $salaryIncomeTax - $employeePension - $otherTaxes;
                        $totalRCC += $redcrosscontribution; 
                        $totalSWF+=250;
                        $Loan = $row["Loan"];
                        $tloan += $Loan;
                        $deduction = $salaryIncomeTax + $employeePension + $redcrosscontribution + $SWF + $Loan;
                        $totalDeduction += $deduction;
                        $net = $totalRowSum - $deduction;
                        $totalNet += $net;
                        $tgs += $grossSalary;


                    echo '<tr>
                        <th scope="row">'.($row["EmployeeID"]).'</th>
                        <td>'.($row["NameOfStaff"]).'</td>
                        <td>'.number_format(floatval($row["BasicSalary"]), 2).'</td>
                        <td>'.number_format(floatval($row["HousingAllowance"]), 2).'</td>
                        <td>'.number_format(floatval($row["OvertimePayment"]), 2).'</td>
                        <td>'.number_format(floatval($row["AnualBonus"]), 2).'</td>
                        <td>'.number_format(floatval($row["CarAllowance"]), 2).'</td>
                        <td>'.number_format(floatval($row["HolydayPay"]), 2).'</td>
                        <td>'.number_format(floatval($totalRowSum), 2).'</td>
                        <td>'.number_format(floatval($grossSalary), 2).'</td>
                        <td>'.number_format(floatval($salaryIncomeTax), 2).'</td>
                        <td>'.number_format(floatval($employeePension), 2).'</td>
                        <td>'.number_format(floatval($redcrosscontribution), 2).'</td>
                        <td>'.number_format(floatval($SWF), 2).'</td>
                        <td>'.number_format(floatval($Loan), 2).'</td>
                        <td>'.number_format(floatval($deduction), 2).'</td>
                        <td>'.number_format(floatval($net), 2).'</td>
                    </tr>';
                    
                    
                    $totalICT += $salaryIncomeTax;
                    $totalPEN += $employeePension;
                    $totalgrossSalary += $grossSalary;
                }

                $sqlsumcolumn = "SELECT 
                SUM(CASE WHEN PaymentCurrency = 'USD' THEN BasicSalary * $er ELSE BasicSalary END) AS totalBasicSalary, 
                SUM(CASE WHEN PaymentCurrency = 'USD' THEN HousingAllowance * $er ELSE HousingAllowance END) AS totalHousingAllowance, 
                SUM(CASE WHEN PaymentCurrency = 'USD' THEN OvertimePayment * $er ELSE OvertimePayment END) AS totalOvertimePayment, 
                SUM(CASE WHEN PaymentCurrency = 'USD' THEN AnualBonus * $er ELSE AnualBonus END) AS totalAnualBonus,
                SUM(CASE WHEN PaymentCurrency = 'USD' THEN CarAllowance * $er ELSE CarAllowance END) AS totalCarAllowance,
                SUM(CASE WHEN PaymentCurrency = 'USD' THEN HolydayPay * $er ELSE HolydayPay END) AS totalHolydayPay
            FROM staff";
            
            // Execute the query with the appropriate binding for :usdMultiplier
            

                $result = $conn->query($sqlsumcolumn);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $totalBasicSalary = $row['totalBasicSalary'];
                    $totalHousingAllowance = $row['totalHousingAllowance'];
                    $totalOvertimePayment = $row['totalOvertimePayment'];
                    $totalAnualBonus = $row['totalAnualBonus'];
                    $totalCarAllowance = $row['totalCarAllowance'];
                    $totalHolydayPay = $row['totalHolydayPay'];
                    $msg = $totalBasicSalary;
                } else {
                    $msg = "No records found.";
                }
                echo '<tr>
                        <th scope="col">Total</th>
                        <th scope="col"> - </th>
                        <th scope="col">' . number_format(floatval($totalBasicSalary), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalHousingAllowance), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalOvertimePayment), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalAnualBonus), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalCarAllowance), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalHolydayPay), 2) . '</th>
                        <th scope="col">' . number_format(floatval($trs), 2) . '</th>
                        <th scope="col">' . number_format(floatval($tgs), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalICT), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalPEN), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalRCC), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalSWF), 2) . '</th>
                        <th scope="col">' . number_format(floatval($tloan), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalDeduction), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalNet), 2) . '</th>
                    </tr>
            </tbody>
            </table>  <br>';
        

            echo '<div class="d-flex justify-content-center mt-3">
            <form class="d-print-none mr-2">
                <input class="btn btn-danger" type="submit" value="Save As A PDF Format" onClick="window.print()" onClick="hideElements()">
            </form>
            
            <form method="post" action="">
                <input type="submit" class="btn btn-primary mx-2 d-print-none" id="saveButton" name="saveButton" value="Save To Database">
            </form>';
                ?>
                    <button type="submit" class="btn btn-success ml-2 d-print-none" onclick="exportToExcel()" id="exportButtonBPS" name="exportButtonBPS"> Export Data As Excel File </button>
            </div>
            <?php            
            } else {
                echo "<div class=\"alert alert-warning col-sm-6 ml-5 mt-2\" role=\"alert\"> No Records Found On The Date You Specified! </div>";
            } 

            if (isset($_REQUEST['saveButton'])) {
                include('Report/incometaxfunction.php');
            } ?>

<script>
    function exportToExcel() {
              // Use the PHP variable in JavaScript
    var dataFromPHP = <?php echo json_encode($data); ?>;
        
              // Create a workbook and add a worksheet
    const ws = XLSX.utils.json_to_sheet(dataFromPHP);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
        
              // Export the workbook to a file
    XLSX.writeFile(wb, 'Payroll_sheet Report For <?php echo $currentMonth .' - '. $currentYear; ?>.xlsx');
        
    }
</script>

          <?php

            