<?php
  define('TITLE', 'Add Employee');
  define('PAGE', 'addemployee');
  include('includes/header.php');
  include('dbConnection.php');
  session_start();
  if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['rEmail'];
  } else {
    echo "<script> location.href='index.php'; </script>";
  }

  // To make the name input read-only
  $sql = "SELECT * FROM requesterlogin_tb WHERE r_email='$rEmail'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $rName = $row["r_name"];
  }

  if (isset($_REQUEST['submitrequest'])) {
    // Checking for Empty Fields
    try {
      if (
        ($_REQUEST['NameOfStaff'] == " ") ||
        ($_REQUEST['EmployeeID'] == " ") ||
        ($_REQUEST['Department'] == " ") ||
        ($_REQUEST['PaymentCurrency'] == " ") ||
        ($_REQUEST['BasicSalary'] == " ") ||
        ($_REQUEST['OvertimePayment'] == " ") ||
        ($_REQUEST['CarAllowance'] == " ") ||
        ($_REQUEST['HousingAllowance'] == " ") ||
        ($_REQUEST['AnualBonus'] == " ") ||
        ($_REQUEST['FCA'] == "") ||
        ($_REQUEST['HolydayPay'] == " ")
      ) {
        // Message displayed if required field is missing
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
      } else {
        // Assigning User Values to Variables
        $NameOfStaff = $_REQUEST['NameOfStaff'];
        $EID = $_REQUEST['EmployeeID'];
        $Department = $_REQUEST['Department'];
        $PaymentCurrency = $_REQUEST['PaymentCurrency'];
        $BasicSalary = $_REQUEST['BasicSalary'];
        $BasicSalary = floatval($BasicSalary);
        $OvertimePayment = $_REQUEST['OvertimePayment'];
        $OvertimePayment = floatval($OvertimePayment);
        $CarAllowance = $_REQUEST['CarAllowance'];
        $CarAllowance = floatval($CarAllowance);
        $HousingAllowance = $_REQUEST['HousingAllowance'];
        $HousingAllowance = floatval($HousingAllowance);
        $AnualBonus = $_REQUEST['AnualBonus'];
        $AnualBonus = floatval($AnualBonus);
        $FCA = $_REQUEST['FCA'];
        $FCA = floatval($FCA);
        $HolydayPay = $_REQUEST['HolydayPay'];
        $HolydayPay = floatval($HolydayPay);
        $BankAcc = $_REQUEST['BankAcc'];
        $BankName = $_REQUEST['BankName'];
        $emptype = $_REQUEST['emptype'];
        $Email = $_REQUEST['Email'];
        $Password = $_REQUEST['Password'];
        $Loan = $_REQUEST['loan'];

        $sql = "INSERT INTO Staff(NameOfStaff, EmployeeID, Department, PaymentCurrency, BasicSalary, HousingAllowance, OvertimePayment, AnualBonus, FCA, CarAllowance, HolydayPay, Loan, BankName, BankAcc, emptype) 
          VALUES ('$NameOfStaff', '$EID', '$Department', '$PaymentCurrency', '$BasicSalary', '$HousingAllowance', '$OvertimePayment', '$AnualBonus', '$FCA', '$CarAllowance', '$HolydayPay', '$Loan', '$BankName', '$BankAcc', '$emptype')";

        $sqle = "INSERT INTO employee(EmployeeID, Email, password) 
        VALUES ('$EID', '$Email', '$Password')";

        if ($conn->query($sql) === TRUE && $conn->query($sqle) === TRUE) {
          // Message displayed on form submit success
          $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Registered Successfully. </div>';
        } else {
          // Message displayed on form submit failure
          $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert" "mx-auto"> Unable to Register </div>';
        }
      }
    } catch (Exception $e) {
      $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert" "mx-auto"> Unable to Register  </div>';
    }
  }
?>

<div class="col-sm-9 col-md-10 mt-5">
  
  <form class="mx-5" action="" method="POST">
    <?php if (isset($msg)) {
      echo $msg;
    } ?>
    <!--<h3 class="text-danger">Upload Excel File :</h3>
    <div div class="form-group col-md-3">
      <input class="form-control" type="file" name="excel-file" id="excel-file">
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-danger" name="import">Import</button>
    </div>-->




    <br><br><h2 class="text-center text-danger">Add Employee Details :</h2><br><br>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="NameOfStaff">Name Of Staff</label>
        <input type="text" class="form-control" id="NameOfStaff" name="NameOfStaff" required>
      </div>
      <div class="form-group col-md-4">
        <label for="EmployeeID">EmployeeID </label>
        <input type="text" class="form-control" id="EmployeeID" name="EmployeeID" required>
      </div>
      <div class="form-group col-md-4">
        <label for="Email">Email </label>
        <input type="Email" class="form-control" id="Email" name="Email" required>
      </div>
    </div>

    <div class="form-row">
      
      <div class="form-group col-md-3">
        <label for="Password">Password</label>
        <input type="password" class="form-control" id="Password" name="Password" required>
      </div>

      <div class="form-group col-md-2">
        <label for="Department">Department</label>
        <select class="form-control text-center" id="Department" name="Department" required>
          <option value=" ">-- Select --</option>
          <option value="Audit">Audit</option>
          <option value="Marketing">Marketing</option>
          <option value="Procurement">Procurement</option>
          <option value="Production">Production</option>
        </select>
      </div>

      <div class="form-group col-md-2">
        <label for="emptype">Employment Type</label>
        <select class="form-control text-center" id="emptype" name="emptype" required>
          <option value=" ">-- Select --</option>
          <option value="Full Time">Full Time</option>
          <option value="Part Time">Part Time</option>
        </select>
      </div>

      <div class="form-group col-md-2">
        <label for="paymentCurrency">Payment Currency</label>
        <select class="form-control text-center" id="PaymentCurrency" name="PaymentCurrency" required>
          <option value=" ">-- Select --</option>
          <option value="ETB">ETB</option>
          <option value="USD">USD</option>
        </select>
      </div>

      <div class="form-group col-md-3">
        <label for="BasicSalary">Basic Salary</label>
        <input type="text" class="form-control" id="BasicSalary" name="BasicSalary" required>
      </div>
      
    </div>

    <div class="form-row">

      <div class="form-group col-md-4">
        <label for="OvertimePayment">Overtime Payment</label>
        <input type="text" class="form-control" id="OvertimePayment" name="OvertimePayment" required>
      </div>

      <div class="form-group col-md-4">
        <label for="CarAllowance">Car Allowance</label>
        <input type="text" class="form-control" id="CarAllowance" name="CarAllowance" required>
      </div>

      <div class="form-group col-md-4">
        <label for="HousingAllowance">Housing Allowance</label>
        <input type="text" class="form-control" id="HousingAllowance" name="HousingAllowance" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="AnualBonus">Anual Bonus</label>
        <input type="text" class="form-control" id="AnualBonus" name="AnualBonus" required>
      </div>
      <div class="form-group col-md-4">
        <label for="FCA">Forign Currency Adjustment</label>
        <input type="text" class="form-control" id="FCA" name="FCA" required>
      </div>
      <div class="form-group col-md-4">
        <label for="HolydayPay">Holyday Pay</label>
        <input type="text" class="form-control" id="HolydayPay" name="HolydayPay" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4">
          <label for="Loan">Loan </label>
          <input type="text" class="form-control" id="loan" name="loan" required>
      </div>
      <div class="form-group col-md-4">
          <label for="BankName">Name Of Bank</label>
          <input type="text" class="form-control" id="BankName" name="BankName" required>
        </div>
        
      <div class="form-group col-md-4">
          <label for="BankAcc">Bank Account Number</label>
          <input type="text" class="form-control" id="BankAcc" name="BankAcc" required>
      </div>
    </div>

    <div class="container mt-5">
      <div class="mx-auto text-center">
        <button type="submit" class="btn btn-danger" name="submitrequest"><i class="fas fa-save"></i> SAVE</button>
        <button type="reset" class="btn btn-secondary"><i class="fas fa-undo"></i> Reset</button>  
      </div>
    </div>
  </form>
  </div>
</div>
</div>
</div>
<?php
include('includes/footer.php'); 
$conn->close();
?>
