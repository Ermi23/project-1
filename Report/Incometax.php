<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<?php

$currentMonth = date("M");
$currentYear = date("Y");

// Fetch data from MySQL
//$sql = "SELECT * FROM payroll_sheet WHERE Datee = '$currentMonth - $currentYear'";
$query = "SELECT * FROM incometax WHERE Datee = '" . $currentMonth . ' - ' . $currentYear . "'";

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
            $totalother = 0;
            $totaltaxcarallowance=0;
            echo '<h3 class=" bg-dark text-white p-2 mt-4 print-section">Income Tax Return Report For '. $Month .' - '. $Year .'</h3>';
            ?>
<style>
    #logo-img{
        width:75px;
        height:75px;
        object-fit:scale-down;
        background : var(--bs-light);
        object-position:center center;
        border:1px solid var(--bs-dark);
        border-radius:50% 50%;
    }
    .truncate-5 {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
    }
    .logo-img{
        width:50px;
        height:50px;
        object-fit:scale-down;
        background : var(--bs-light);
        object-position:center center;
        border:1px solid var(--bs-dark);
        border-radius:50% 50%;
    }
</style>
<div class="card">
    <div class="card-header d-flex">
    
    <img src="images/picture1.jpg">
            <h5 class="card-title flex-grow-1 bg-info bg-dark text-light ">&nbsp&nbsp <b> ኢትዮጲያ ፌደራላዊ ዲሞከራሲያዊ ሪፐብሊክ<br>&nbsp&nbsp
 የኢትዮጲያ ገቢዎችና ጉሙሩክ ባለስልጣን</b> 
 <h5 class="card-title flex-grow-1">&nbsp&nbsp <b>  ሠንጠረዥ "ሀ" የስራ ግብር ክፍያ ማስታወቂያ ቅጽ (ለተቀጣሪዎች)
<br>&nbsp&nbsp
(የገቢ ግብር አዋጅ ቁጥር 976/2016 ና ገቢ ግብር ደንብ ቁጥር 410/2009)</b>

</h5>
        <div class="w-auto d-flex justify-content-end">
           
            <img src="images/picture2.jpg">

        </div>
    </div>
    <div class="card-body">
    <style>
    .center-table {
        margin: 0 auto;
    }
    
</style>

<table class="center-table">
    <tr>
        <th class="text-center bg-info bg-light text-dark" colspan="2">&nbsp;&nbsp;ክፍል 1 የግብር ከፋይ ዝርዝር መረጃ</th>
    </tr>
</table>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    
    table th,
    table td {
        border: 1px solid black;
        padding: 8px;
    }
    
    table th {
        background-color: #f2f2f2;
    }
</style>

<table>
    <tr>
        <th>የግብር ከፋይ ስም: Quit Company</th>
        <th>የግብር ከፋይ መለያ ቁጥር:</th>
        <th>የግብር ከፋይ ሂሳብ ቁጥር:</th>
    
       <th class="text-center py-1" colspan="2">የክፍያ ጊዜ:</th>
        
            <td>ወር: <?php echo $Month ;?> </td>
            <td>ዓ.ም. <?php echo $Year ;?></td>    
    </tr>
    <tr>
        <th>2a. ከልል</th>
        <th>2b. ዞን/ክፍለ ከተማ</th>
        <th  class="text-center py-1" colspan="3">5. የግብር ሰብሳቢ መ/ቤት ስም</th>
        <th  class="text-center  border-bottom-0  py-1" colspan="4" >የሰነድ ቁጥር (ለቢሮ አገልግሎት ብቻ)</th>
        <tr>
        <th>2c. ወረዳ</th>
        <th>2d. ቀበሌ/ገበሬ ማህበር </th>
        <th>2e. የቤት ቁጥር</th>
        <th>6. የስልክ ቁጥር</th>
        <th>7. ፋክስ ቁጥር</th>   
        <th  class="text-center  border-top-0 py-1" colspan="4"></th>    
    </tr>
    <th  class="text-center py-1" colspan="10">ሠንጠረዥ 2. ማስታወቂያ ዝርዝር መረጃ</th> 
</table>   
<?php
            if ($result->num_rows > 0) {
                echo '
                <table class="table print-section">
                    <thead>
                        <tr>
                          <th>መለያ ኮድ</th>
                          <th>የሠራተኛው ስም የአባት ስምና የአያት ስም</th>
                          <th>የተቀጠሩበት ቀን</th>
                          <th>ደምወዝ</th>
                          <th>ጠቅላላ የትራንስፖርት አበል</th>
                          <th>የስራ ንግድ ግብር የሚከፈልበት የትራንስፖርት አበል</th>
                          <th>የትርፍ ሰዓት ክፍያ</th>
                          <th>ሌሎች ጥቅማ ጥቀሞች</th>
                          <th>ጠቅላላ ግብር የሚከፈልበት ብር</th>
                          <th>የስራ ግብር</th>
                          <th>የትምህርት ወጪ መጋራት</th>
                          <th>የተጣራ ክፍያ</th>
                          <th>የሠራተኛ ፊርማ</th>
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


                        echo '<tr>
                        <td scope="row">' . number_format(floatval($row["EmployeeID"]), 2) . '</td>
                        <td>' . htmlspecialchars($row["NameOfStaff"]) . '</td>
                        <td>' . $Month . ' ' . $Year . '</td>
                        <td>' . number_format(floatval($row["BasicSalary"]), 2) . '</td>
                        <td>' . number_format(floatval($row["CarAllowance"]), 2) . '</td>
                        <td>' . number_format(floatval($taxcarallowance), 2) . '</td>
                        <td>' . number_format(floatval($row["OvertimePayment"]), 2) . '</td>
                        <td>' . number_format(floatval($other), 2) . '</td>
                        <td>' . number_format(floatval($totalRowSum), 2) . '</td>
                        <td>' . number_format(floatval($salaryIncomeTax), 2) . '</td>
                        <td> - </td>
                        <td>' . number_format(floatval($net), 2) . '</td>
                        <td> </td>
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
                        <th scope="col"> - </th>
                        <th scope="col">' . number_format(floatval($totalBasicSalary), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalCarAllowance), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totaltaxcarallowance), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalOvertimePayment), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalother), 2) . '</th>
                        <th scope="col">' . number_format(floatval($trs), 2) . '</th>
                        <th scope="col">' . number_format(floatval($totalICT), 2) . '</th>
                        <th scope="col"> - </th>
                        <th scope="col">' . number_format(floatval($totalNet), 2) . '</th>
                        <th scope="col"> - </th>
                    </tr>
                    </tbody>
                    </table>';

                    echo '<div class="d-flex justify-content-center mt-3 d-print-none">
                    <form class="d-print-none mr-2">
                        <input class="btn btn-danger" type="submit" value="Save As A PDF Format" onClick="window.print()" onClick="hideElements()">
                    </form>
                    
                    <form method="post" action="">
                        <input type="submit" class="btn btn-primary mx-2" id="saveButtonit" name="saveButtonit" value="Save To Database">
                        </form>';
                        ?>
                            <button type="submit" class="btn btn-success ml-2" onclick="exportToExcel()" id="exportButtonBPS" name="exportButtonBPS"> Export Data As Excel File </button>
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
      XLSX.writeFile(wb, 'Income_Tax_Return Report For <?php echo $currentMonth .' - '. $currentYear; ?>.xlsx');

    }
  </script>
  <?php          