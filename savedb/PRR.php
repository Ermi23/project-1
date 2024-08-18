<?php
            $currentDate = date("D");
            $Month = date("M");
            $Year = date("Y");
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
            $tca = 0;
            
            

            $sqlCheck = "SELECT * FROM Pension_Return WHERE Datee = '$Month - $Year'";
            $resultCheck = $conn->query($sqlCheck);
            
            if ($resultCheck->num_rows > 0) {
                // Date already exists, do something (e.g., display a message)
                echo '<div class="alert alert-warning mt-2 mx-auto" role="alert"> Income Tax For this Month is already calculated and stored in the database. </div>';
            } 
            else {

            $sql = "SELECT * FROM staff ";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $a = $row["EmployeeID"];
                    $sqlsumrow = "SELECT BasicSalary, HousingAllowance, OvertimePayment, AnualBonus, CarAllowance, HolydayPay FROM staff WHERE EmployeeID = '$a'";
                    $resultSum = $conn->query($sqlsumrow);
                    $rowSum = $resultSum->fetch_assoc();
                    $totalRowSum = $rowSum['BasicSalary'] + $rowSum['HousingAllowance'] + $rowSum['OvertimePayment'] + $rowSum['AnualBonus'] + $rowSum['CarAllowance'] + $rowSum['HolydayPay'];
                    $trs += $totalRowSum;
                        if($rowSum['CarAllowance'] < ($rowSum['BasicSalary'] * 0.25) ) {
                            $grossSalary = $totalRowSum - $rowSum['CarAllowance'];
                        }
                        else{
                            $grossSalary =  $totalRowSum - ( $rowSum['BasicSalary'] * 0.25 );
                            $tca = $rowSum['BasicSalary'] * 0.25;
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
                        $employeePension = $row["BasicSalary"] * $pensionRate;
                        $salaryIncomeTax = ($grossSalary * $taxRate) - $deduction;
                        $companyPension = $row["BasicSalary"] * $companyPensionRate;
                        $otherTaxes = 0; // Add other taxes here if applicable
                        $netSalary = $grossSalary - $salaryIncomeTax - $employeePension - $otherTaxes;
                        $redcrosscontribution = $row["BasicSalary"] * 0.05;
                        $totalRCC += $redcrosscontribution; 
                        $totalSWF+=250;
                        $Loan = $row["Loan"];
                        $deduction = $salaryIncomeTax + $employeePension + $redcrosscontribution + $SWF +$Loan;
                        $totalDeduction += $deduction;
                        $net = $totalRowSum - $deduction;
                        $totalNet += $net;
                        $tgs += $grossSalary;
                        $other = $row["AnualBonus"] + $row["HousingAllowance"] + $row["HolydayPay"];

                        $empid= $row["EmployeeID"];
                        $basa = $row["BasicSalary"];
                        $ha = $row["HousingAllowance"];
                        $op = $row["OvertimePayment"];
                        $ab = $row["AnualBonus"];
                        $ca = $row["CarAllowance"];
                        $hp = $row["HolydayPay"];
                        $names = $row["NameOfStaff"]; 
                        $Bnames = $row["BankName"]; 
                        $BAcc = $row["BankAcc"];                
                        $totalICT += $salaryIncomeTax;
                        $totalPEN += $employeePension;
                        $totalgrossSalary += $grossSalary;
                        $ld=0.00;
                        $Plus = $companyPension + $employeePension;

$query = "INSERT INTO `pension_return`(`መለያ ኮድ`, `የቋሚ ሠራተኛው የግብር ከፋይ መለያ ቁጥር (TIN)`, `የሠራተኛው ስም የአባት ስምና የአያት ስም`, `የተቀጠሩበት ቀን`, `ደምወዝ`, `የሰራተኛው መዋጮ መጠን 7%/ብር/`, `የአሰሪው መዋጮ መጠን 11%/ብር/`, `በአሰሪው የሚገባ ጥቅል መዋጮ 18%/ብር/`, `Datee`) 
VALUES ('$empid',' - ', '$names','01- $Month - $Year','$basa','$employeePension','$companyPension','$Plus','$Month - $Year')";
                       if ($conn->query($query) === TRUE) {
                        // Message displayed on form submit success
                       // echo '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Registered Successfully. </div>';
                      } else {
                        // Message displayed on form submit failure
                       // echo '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Register </div>';
                      }
                }
                echo '<div class="alert alert-success mt-2 mx-auto" role="alert"> Registered Successfully. </div>';
            }
        }
                ?>