    <?php
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
            $totalother = 0;
            $totaltaxcarallowance=0;
            $tbs = 0;
            
            
            if ($result->num_rows > 0) {
                echo '
                ';
                                            // Your code here
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
                    $tbs += $row['BasicSalary'];
                    
                        if($row['CarAllowance'] < ($row['BasicSalary'] * 0.25) ) {
                            $grossSalary = $totalRowSum - $row['CarAllowance'];
                            $taxcarallowance = 0;
                        }
                        else{
                            $grossSalary =  $totalRowSum - ( $row['BasicSalary'] * 0.25 );
                            $taxcarallowance = $row['CarAllowance'] - ($row['BasicSalary'] * 0.25);
                        }

                        $totaltaxcarallowance += $taxcarallowance;
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
                        $deduction = $salaryIncomeTax + $employeePension + $redcrosscontribution + $SWF + $Loan;
                        $totalDeduction += $deduction;
                        $net = $totalRowSum - $deduction;
                        $totalNet += $net;
                        $other = $row["AnualBonus"] + $row["HousingAllowance"] + $row["HolydayPay"];
                        $totalother += $other;
                        $totalICT += $salaryIncomeTax;
                        $totalPEN += $employeePension;
                        $totalgrossSalary += $grossSalary;
                }?>

<div class="bg-danger text-white p-2 mt-4 print-section">
    <h1>Quit Company Payroll Journal</h1>
    <h3>Report Generated on: <?php echo "$Month - $Year"; ?></h3>
</div>

<table class="table print-section">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Account</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>4001 - Salary Expense</td>
            <td><?php echo number_format(floatval($trs), 2); ?></td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>2001 Salaries Payable</td>
            <td><?php echo number_format(floatval($totalNet), 2); ?></td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>2002 Income Tax Payable</td>
            <td><?php echo number_format(floatval($totalICT), 2); ?></td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>2003 PF Payable (Employee)</td>
            <td>0.00</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>2004- Pension Payable (Employee)</td>
            <td><?php echo number_format(floatval($totalPEN), 2); ?></td>
        </tr>
        <tr>
            <th scope="row">6</th>
            <td>2005 Other Payroll Payable</td>
            <td>0.00</td>
        </tr>
    </tbody>
</table>

<?php
    echo '<tr>
            <td>
                <form class="d-print-none">
                    <input class="btn btn-danger" type="submit" value="Print As PDF Format" onClick="window.print()">
                </form>
            </td>
        </tr>';
} else {
    echo "<div class=\"alert alert-warning col-sm-6 ml-5 mt-2\" role=\"alert\"> No Records Found On The Date You Specified! </div>";
}
?>
