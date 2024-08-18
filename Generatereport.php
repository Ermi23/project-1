<?php
define('TITLE', 'Generate Report');
define('PAGE', 'generatereport');
include('includes/header.php');
include('dbConnection.php');
session_start();
if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='index.php'; </script>";
}
$currentDate = date("D");
$currentMonth = date("M");
$currentYear = date("Y");
        
?>

<div class=" col-sm-9 col-md-20 mt-5 text-center ml-auto container d-flex justify-content-center align-items-center">
<form method="POST" action="" class="text-center d-print-none" id="inputBox">

<div class="form-row justify-content-center align-items-center">
    
    <div class="form-group col-md-3">
        <input type="text" class="form-control form-control-lg" id="Month" name="Month" placeholder="Month: <?php echo $currentMonth ?>" value="<?php echo $currentMonth ?>" readonly>
    </div>

    <div class="form-group col-md-3">
        <input type="text" class="form-control form-control-lg" id="Year" name="Year" placeholder="Year: <?php echo $currentYear ?>" value="<?php echo $currentYear ?>" readonly>
    </div>

    <div class="form-group col-md-6">
        <select class="form-control form-control-lg custom-select" id="reporttype" name="reporttype">
        <option value="" style="text-align: center;"> -- Select Report Type --</option>
        <option value="PRS" style="height: 40px; text-align: center;">Payroll Sheet</option>
        <option value="PSI" style="height: 40px; text-align: center;">Payslip - Individual</option>
        <option value="BPS" style="height: 40px; text-align: center;">Bank Payment Sheet</option>
        <option value="DP" style="height: 40px; text-align: center;">Department Payroll</option>
        <option value="ITR" style="height: 40px; text-align: center;">Income Tax Return</option>
        <option value="PR" style="height: 40px; text-align: center;">Pension Return</option>
        <option value="JEBT" style="height: 40px; text-align: center;">Journal Entry</option>
        </select>
    </div>


    <div class="form-group col-md-12">
        <input type="text" class="form-control form-control-lg" id="emp" name="emp" placeholder="Enter The Key To Filter" readonly>
    </div>

    <div class="form-group col-md-12">
        <button type="submit" name="searchsubmit" class="btn btn-danger btn-lg">Generate</button>
    </div>

</div>
</form>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var reportTypeSelect = document.getElementById("reporttype");
        var empInput = document.getElementById("emp");

        reportTypeSelect.addEventListener("change", function () {
            var selectedValue = reportTypeSelect.value;

            // Check if the selected value is "PSI" (Payslip - Individual)
            if (selectedValue === "PSI" || selectedValue === "DP") {
                // Enable input and remove readonly attribute
                empInput.removeAttribute("readonly");
            } else {
                // Disable input and set readonly attribute
                empInput.setAttribute("readonly", "readonly");
            }
        });
    });
</script>

<?php
        if (isset($_REQUEST['searchsubmit'])) {
            
            $Month = $_REQUEST['Month'];
            $Year = $_REQUEST['Year'];
            $reporttype = $_REQUEST['reporttype'];
            if ($reporttype == "PRS") {
                echo '</div>';
                echo'<div class="col-12 mt-0 text-center">';
                include('Report/payrollsheet.php');
            }
            elseif ($reporttype == "PSI") {
                echo '</div>';
                echo'<div class="col-12 ml-0 text-center">';
            include('Report/payslip.php');
            }
            elseif ($reporttype == "BPS") {
                echo '</div>';
                echo'<div class="col-12 ml-0 text-center">';
            include('Report/bankreport.php');
            }
            elseif ($reporttype == "DP") {
                echo '</div>';
                echo'<div class="col-12 text-center">';
            include('Report/departmentreport.php');
            }
            elseif ($reporttype == "ITR") {
                echo '</div>';
                echo'<div class="col-12 text-center">';
                include('Report/Incometax.php');
            }
            elseif ($reporttype == "JEBT") {
                echo '</div>';
                echo'<div class="col-12 ml-0 text-center">';
                include('Report/journal.php');
            }
            elseif ($reporttype == "PR") {
                echo '</div>';
                echo'<div class="col-12 text-center">';
                include('Report/PensionReturn.php');
            }
             }
    ?>
</div>
<?php
if (isset($_REQUEST['saveButton'])) {
        include('savedb/incometaxfunction.php');
            }
if (isset($_REQUEST['saveButtonBPS'])) {
    include('savedb/BPS.php');
            }
if (isset($_REQUEST['saveButtonit'])) {
        include('savedb/ICT.php');
            }
if (isset($_REQUEST['saveButtonpr'])) {
        include('savedb/PRR.php');
            }
            ?>

<?php
include('includes/footer.php');
?>
