<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
<?php
$currentMonth = date("M");
$currentYear = date("Y");

// Fetch data from MySQL
//$sql = "SELECT * FROM payroll_sheet WHERE Datee = '$currentMonth - $currentYear'";
$query = "SELECT * FROM bank_payment_sheet WHERE Datee = '" . $currentMonth . ' - ' . $currentYear . "'";

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
            
            if ($result->num_rows > 0) {
                echo '
                <h2 class=" bg-dark text-white p-2 mt-1 ml-0 print-section">Bank Transfer List Report For '. $Month .' - '. $Year .'</h2>
                <table class="table print-section">
                    <thead>
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Bank Name</th>
                            <th scope="col">Account Number</th>
                            <th scope="col">Net Pay</th>
                        </tr>
                    </thead>
                    <tbody>';

                    $sqli = "SELECT * FROM exchange_rate";
                        $resulti = $conn->query($sqli);
                        if ($resulti->num_rows == 1) {
                            $rowi = $resulti->fetch_assoc();
                            $er = floatval($rowi["ETB"]);
                        }

                while ($row = $result->fetch_assoc()) {
                    $a = $row["EmployeeID"];

                    // $sqlsumrow = "SELECT BasicSalary, HousingAllowance, OvertimePayment, AnualBonus, CarAllowance, HolydayPay FROM staff WHERE EmployeeID = '$a'";
                    // $resultSum = $conn->query($sqlsumrow);
                    // $rowSum = $resultSum->fetch_assoc();
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
                    $employeePension = floatval($row["BasicSalary"]) * 0.07;
                    $companyPension = floatval($row["BasicSalary"]) * 0.11;
                    
                    if (floatval($row['CarAllowance']) < (floatval($row['BasicSalary']) * 0.25)) {
                        $grossSalary = $totalRowSum - floatval($row['CarAllowance']);
                    } else {
                        $grossSalary = $totalRowSum - (floatval($row['BasicSalary']) * 0.25);
                    }


                        $taxRate = 0;
                        $deductionn = 0;
                        $deduction = 0;
                
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
                
                        $salaryIncomeTax = (floatval($grossSalary) * $taxRate) - $deductionn;
                        $otherTaxes = 0; // Add other taxes here if applicable

                        if ($row['PaymentCurrency'] == 'USD') {
                            $redcrosscontribution = 0;
                            $SWF = 0;
                            $deduction = $salaryIncomeTax + $employeePension + $redcrosscontribution + $SWF + floatval($row["Loan"]);  
                        }
                        else {
                            $SWF = 250;
                        $redcrosscontribution = floatval($row["BasicSalary"]) * 0.05; 
                        $deduction = $salaryIncomeTax + $employeePension + $redcrosscontribution + $SWF + floatval($row["Loan"]);
                        }
                
                        $netSalary = $grossSalary - $salaryIncomeTax - $employeePension - $otherTaxes;
                        $totalRCC += $redcrosscontribution; 
                        $totalSWF+=250;
                        $Loan = floatval($row["Loan"]);
                        $deduction = $salaryIncomeTax + $employeePension + $redcrosscontribution + $SWF + $Loan;
                        $totalDeduction += $deduction;
                        $net = $totalRowSum - $deduction;
                        $totalNet += floatval($net);


                    echo '<tr>
                        <th scope="row">'.$row["EmployeeID"].'</th>
                        <td>'.$row["NameOfStaff"].'</td>
                        <td>'.$row["BankName"].'</td>
                        <td>'.$row["BankAcc"].'</td>
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

                $result = $conn->query($sqlsumcolumn);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $totalBasicSalary = floatval($row['totalBasicSalary']);
                    $totalHousingAllowance = floatval($row['totalHousingAllowance']);
                    $totalOvertimePayment = floatval($row['totalOvertimePayment']);
                    $totalAnualBonus = floatval($row['totalAnualBonus']);
                    $totalCarAllowance = floatval($row['totalCarAllowance']);
                    $totalHolydayPay = floatval($row['totalHolydayPay']);
                    $msg = $totalBasicSalary;
                } else {
                    $msg = "No records found.";
                }

                echo '<tr>
                        <th scope="col">Total</th>
                        <th scope="col"> - </th>
                        <th scope="col"> - </th>
                        <th scope="col"> - </th>
                        <th scope="col">'.number_format(floatval($totalNet), 2).'</th>
                    </tr>
                    </tbody>
                </table>';

                echo '
                <div class="d-flex justify-content-center mt-3">
                <form class="d-print-none mr-2">
                    <input class="btn btn-danger" type="submit" value="Print As PDF Format" onClick="window.print()">
                </form>
            
                <form method="post" action="">
                    <input type="submit" class="btn btn-primary mx-2 d-print-none" id="saveButtonBPS" name="saveButtonBPS" value="Save To Database">
                </form>';
                ?>
                    <button type="submit" class="btn btn-success ml-2 d-print-none" onclick="exportToExcel()" id="exportButtonBPS" name="exportButtonBPS"> Export Data As Excel File </button>
            </div>
            <?php            
            } else {
                echo "<div class=\"alert alert-warning col-sm-6 ml-5 mt-2\" role=\"alert\"> No Records Found On The Date You Specified! </div>";
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
              XLSX.writeFile(wb, 'Bank_Payment_sheet Report For <?php echo $currentMonth .' - '. $currentYear; ?>.xlsx');
        
            }
          </script>

          <?php

            