
<?php
$Month = $_REQUEST['Month'];
$Year = $_REQUEST['Year'];
$reporttype = $_REQUEST['reporttype'];
$a = $_REQUEST["emp"];
$sql = "SELECT * FROM staff WHERE Department = '$a'";
$result = $conn->query($sql);
$trs = 0;
$totalICT = 0;
$totalPEN = 0;
$totalgrossSalary = 0;
$totalRCC = 0;
$totalSWF = 0;
$SWF = 250;
$totalDeduction = 0;
$totalNet = 0;
$tloan = null;


if ($a == 'Audit' || $a == 'Marketing' || $a == 'Procurement' || $a == 'Production') {
    if ($result->num_rows > 0) {
        echo '
        <h2 class="bg-secondary text-white p-2 mt-4 print-section">' . $a . ' Payroll Sheet Report For ' . $Month . ' - ' . $Year . '</h2>
        <table class="table print-section">
            <thead>
                <tr>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Basic Salary</th>
                    <th scope="col">Housing Allowance</th>
                    <th scope="col">Overtime Payment</th>
                    <th scope="col">Annual Bonus</th>
                    <th scope="col">Car Allowance</th>
                    <th scope="col">Holiday Pay</th>
                    <th scope="col">Total Income</th>
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

// Your code here
$sqli = "SELECT * FROM exchange_rate";
$resulti = $conn->query($sqli);
if ($resulti->num_rows == 1) {
  $rowi = $resulti->fetch_assoc();
  $er = floatval($rowi["ETB"]);
}

        while ($row = $result->fetch_assoc()) {
             $sqlsumrow = "SELECT BasicSalary, HousingAllowance, OvertimePayment, AnualBonus, CarAllowance, HolydayPay FROM staff WHERE Department = '$a'";
             $resultSum = $conn->query($sqlsumrow);

            if ($resultSum->num_rows > 0) {
                $rowSum = $resultSum->fetch_assoc();
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

                if ($row['CarAllowance'] < ($row['BasicSalary'] * 0.25)) {
                    $grossSalary = $totalRowSum - $row['CarAllowance'];
                } else {
                    $grossSalary =  $totalRowSum - ($row['BasicSalary'] * 0.25);
                }

                $taxRate = 0;
                $deduction = 0;
                $deductionn = 0;
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
                $totalSWF += 250;
                $SWF = 250; // Not sure why $SWF is being reset here, but included it for consistency
                $Loan = $row["Loan"];
                $tloan += $Loan;
                $deduction = $salaryIncomeTax + $employeePension + $redcrosscontribution + $SWF + $Loan;
                $totalDeduction += $deduction;
                $net = $totalRowSum - $deduction;
                $totalNet += $net;

                echo '<tr>
                        <th scope="row">' .$row["EmployeeID"] . '</th>
                        <td>' . $row["NameOfStaff"]. '</td>
                        <td>' . number_format(floatval($row["BasicSalary"]), 2) . '</td>
                        <td>' . number_format(floatval($row["HousingAllowance"]), 2) . '</td>
                        <td>' . number_format(floatval($row["OvertimePayment"]), 2) . '</td>
                        <td>' . number_format(floatval($row["AnualBonus"]), 2) . '</td>
                        <td>' . number_format(floatval($row["CarAllowance"]), 2) . '</td>
                        <td>' . number_format(floatval($row["HolydayPay"]), 2) . '</td>
                        <td>' . number_format(floatval($totalRowSum), 2) . '</td>
                        <td>' . number_format(floatval($salaryIncomeTax), 2) . '</td>
                        <td>' . number_format(floatval($employeePension), 2) . '</td>
                        <td>' . number_format(floatval($redcrosscontribution), 2) . '</td>
                        <td>' . number_format(floatval($SWF), 2) . '</td>
                        <td>' . number_format(floatval($Loan), 2) . '</td>
                        <td>' . number_format(floatval($deduction), 2) . '</td>
                        <td>' . number_format(floatval($net), 2) . '</td>
                    </tr>';


                $totalICT += $salaryIncomeTax;
                $totalPEN += $employeePension;
                $totalgrossSalary += $grossSalary;
            }
        }

        $sqlsumcolumn = "SELECT 
        SUM(CASE WHEN PaymentCurrency = 'USD' THEN BasicSalary * $er ELSE BasicSalary END) AS totalBasicSalary, 
        SUM(CASE WHEN PaymentCurrency = 'USD' THEN HousingAllowance * $er ELSE HousingAllowance END) AS totalHousingAllowance, 
        SUM(CASE WHEN PaymentCurrency = 'USD' THEN OvertimePayment * $er ELSE OvertimePayment END) AS totalOvertimePayment, 
        SUM(CASE WHEN PaymentCurrency = 'USD' THEN AnualBonus * $er ELSE AnualBonus END) AS totalAnualBonus,
        SUM(CASE WHEN PaymentCurrency = 'USD' THEN CarAllowance * $er ELSE CarAllowance END) AS totalCarAllowance,
        SUM(CASE WHEN PaymentCurrency = 'USD' THEN HolydayPay * $er ELSE HolydayPay END) AS totalHolydayPay
                    FROM staff WHERE Department = '$a'";


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
                <th scope="col">' . number_format(floatval($trs), 2) . ' </th>
                <th scope="col">' . number_format(floatval($totalICT), 2) . '</th>
                <th scope="col">' . number_format(floatval($totalPEN), 2) . '</th>
                <th scope="col">' . number_format(floatval($totalRCC), 2) . '</th>
                <th scope="col">' . number_format(floatval($totalSWF), 2) . '</th>
                <th scope="col">' . number_format(floatval($tloan), 2) . '</th>
                <th scope="col">' . number_format(floatval($totalDeduction), 2) . '</th>
                <th scope="col">' . number_format(floatval($totalNet), 2) . '</th>
            </tr>';

        echo '<tr>
                <td>
                    <form class="d-print-none">
                        <input class="btn btn-danger" type="submit" value="Print As PDF Format" onClick="window.print()">
                    </form>
                </td>
            </tr>
            </tbody>
        </table>';
    } else {
        echo "<div class=\"alert alert-warning col-sm-6 ml-5 mt-2 mx-auto\" role=\"alert\"> No Records Found On The Date You Specified! </div>";
    }
} else {
    echo "<div class=\"alert alert-warning col-sm-6 ml-5 mt-2 mx-auto\" role=\"alert\"> No Records Found On The key you Specified!</div>";
}
