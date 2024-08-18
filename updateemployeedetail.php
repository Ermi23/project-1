<?php
define('TITLE', 'Staff List');
define('PAGE', 'stafflist');
include('includes/header.php');
include('dbConnection.php');
session_start();
if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='index.php'; </script>";
}
if (isset($_REQUEST['empupdate'])) {
    $EmployeeID = $_POST['EmployeeID'];
    $NameOfStaff = $_POST['NameOfStaff'];
    $Department = $_POST['Department'];
    $PaymentCurrency = $_POST['PaymentCurrency'];
    $BasicSalary = floatval($_POST['BasicSalary']);
    $OvertimePayment = floatval($_POST['OvertimePayment']);
    $CarAllowance = floatval($_POST['CarAllowance']);
    $HousingAllowance = floatval($_POST['HousingAllowance']);
    $AnualBonus = floatval($_POST['AnualBonus']);
    $FCA = floatval($_POST['FCA']);
    $HolydayPay = floatval($_POST['HolydayPay']);
    $BankName = $_POST['BankName'];
    $BankAcc = $_POST['BankAcc'];
    $Loan = floatval($_POST['loan']);

    $sql = "UPDATE staff SET NameOfStaff = '$NameOfStaff', Department='$Department', PaymentCurrency = '$PaymentCurrency', BasicSalary = '$BasicSalary', HousingAllowance = '$HousingAllowance', OvertimePayment = '$OvertimePayment', AnualBonus='$AnualBonus', FCA = '$FCA', CarAllowance = '$CarAllowance', Loan='$Loan', BankName = '$BankName', BankAcc = '$BankAcc', HolydayPay = '$HolydayPay' WHERE EmployeeID = '$EmployeeID'";

    if ($conn->query($sql) === TRUE) {
        $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
        header("Location: Stafflist.php");
    } else {
        $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
    }
}

?>

<div class="col-sm-6 mt-5  mx-3 jumbotron">
    <h3 class="text-center">Update Employee's Detail</h3>
    <br> <br>
    <?php
    if (isset($_REQUEST['view'])) {
        $id = $_REQUEST['id'];
        $sql = "SELECT * FROM staff WHERE EmployeeID = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>
    <form action="" method="POST">
        <?php if (isset($msg)) {
            echo $msg;
        } ?>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="empId"><b>Expert ID :</b></label>
                <input type="text" class="form-control" id="EmployeeID" name="EmployeeID" value="<?php if (isset($row['EmployeeID'])) {
                                                                                                        echo $row['EmployeeID'];
                                                                                                    } ?>" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="Name"><b>Name Of Staff :</b></label>
                <input type="text" class="form-control" id="NameOfStaff" name="NameOfStaff" value="<?php if (isset($row['NameOfStaff'])) {
                                                                                                        echo $row['NameOfStaff'];
                                                                                                    } ?>">
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Department"><b>Department</b></label>
                <select class="form-control" id="Department" name="Department">
                    <option value="<?php echo $row['Department']; ?>"><?php echo $row['Department']; ?> </option>
                    <option value="Marketing">Marketing</option>
                    <option value="Procurement">Procurement</option>
                    <option value="Audit">Audit</option>
                    <option value="Production">Production</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="pass"><b>Payment Currency : </b></label>
                <select class="form-control" id="PaymentCurrency" name="PaymentCurrency">
                    <option value="<?php echo $row['PaymentCurrency']; ?>"><?php echo $row['PaymentCurrency']; ?> </option>
                    <option value="ETB">ETB</option>
                    <option value="USD">USD</option>
                </select>
            </div>
        </div>

        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="empMobile"><b>Basic Salary :</b></label>
                <input type="text" class="form-control" id="BasicSalary" name="BasicSalary" value="<?php if (isset($row['BasicSalary'])) {
                                                                                                        echo $row['BasicSalary'];
                                                                                                    } ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="address"><b>Overtime Payment : </b></label>
                <input type="text" class="form-control" id="OvertimePayment" name="OvertimePayment" value="<?php if (isset($row['OvertimePayment'])) {
                                                                                                                echo $row['OvertimePayment'];
                                                                                                            } ?>">
            </div>

        </div>

        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="empMobile"><b>Housing Allowance :</b></label>
                <input type="text" class="form-control" id="HousingAllowance" name="HousingAllowance" value="<?php if (isset($row['HousingAllowance'])) {
                                                                                                                    echo $row['HousingAllowance'];
                                                                                                                } ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="empMobile"><b>Car Allowance :</b></label>
                <input type="text" class="form-control" id="CarAllowance" name="CarAllowance" value="<?php if (isset($row['CarAllowance'])) {
                                                                                                            echo $row['CarAllowance'];
                                                                                                        } ?>">
            </div>

        </div>

        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="empMobile"><b>Annual Bonus :</b></label>
                <input type="text" class="form-control" id="AnualBonus" name="AnualBonus" value="<?php if (isset($row['AnualBonus'])) {
                                                                                                        echo $row['AnualBonus'];
                                                                                                    } ?>">
            </div>

            <div class="form-group col-md-4">
                <label for="empMobile"><b>FCA :</b></label>
                <input type="text" class="form-control" id="FCA" name="FCA" value="<?php if (isset($row['FCA'])) {
                                                                                            echo $row['FCA'];
                                                                                        } ?>">
            </div>

            <div class="form-group col-md-4">
              <label for="empMobile"><b>Holiday Pay :</b></label>
              <input type="text" class="form-control" id="HolydayPay" name="HolydayPay" value="<?php if (isset($row['HolydayPay'])) {
                                                                                                        echo $row['HolydayPay'];
                                                                                                    } ?>">
            </div>

        </div>

        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="BankName"><b>Name Of Bank :</b></label>
                <input type="text" class="form-control" id="BankName" name="BankName" value="<?php if (isset($row['BankName'])) {
                                                                                                        echo $row['BankName'];
                                                                                                    } ?>">
            </div>

            <div class="form-group col-md-4">
                <label for="BankAcc"><b>Bank Account Number :</b></label>
                <input type="text" class="form-control" id="BankAcc" name="BankAcc" value="<?php if (isset($row['BankAcc'])) {
                                                                                            echo $row['BankAcc'];
                                                                                        } ?>">
            </div>

            <div class="form-group col-md-3">
                <label for="Loan"><b>Loan :</b></label>
                <input type="text" class="form-control" id="loan" name="loan" value="<?php if (isset($row['Loan'])) {
                                                                                            echo $row['Loan'];
                                                                                        } ?>">
            </div>

            <!--<div class="form-group col-md-4">
            <label for="empMobile"><b>Holiday Pay :</b></label>
            <input type="text" class="form-control" id="HolydayPay" name="HolydayPay" value="<?php if (isset($row['HolydayPay'])) {
                                                                                                        echo $row['HolydayPay'];
                                                                                                    } ?>">
            </div>-->

        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="empupdate" name="empupdate">Update</button>
            <a href="stafflist.php" class="btn btn-secondary">Close</a>
        </div>
    </form>
</div>

<?php
include('includes/footer.php');
?>