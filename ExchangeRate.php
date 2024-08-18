<?php
  define('TITLE', 'Exchange Rate');
  define('PAGE', 'exchangerate');
  include('includes/header.php');
  include('dbConnection.php');
  session_start();
  if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['rEmail'];
  } else {
    echo "<script> location.href='index.php'; </script>";
  }
  $i=1;
$etb=null;
$msg=null;

//   // To make the name input read-only
   $sql = "SELECT * FROM exchange_rate WHERE ID='$i'";
   $res = $conn->query($sql);
   if ($res->num_rows == 1) {
     $r = $res->fetch_assoc();
     $rName = $r["ETB"];
   }

if (isset($_REQUEST['update'])) {
    $usd = 1;
    $etb = floatval($_POST['etb']); 
    // Update: Changed 'ETB' to 'etb'

    if ($_POST['etb'] == "") {
        // Message displayed if required field is missing
        $msg = '<div class="alert alert-warning col-sm-3 ml-5 mt-2 text-center mx-auto" role="alert"> Fill The Fields </div>';
      }
    else {
    $sqle = "UPDATE exchange_rate SET ETB = '$etb' WHERE ID ='$i' ";
    if ($conn->query($sqle) === TRUE) {
        $msg = '<div class="alert alert-success col-sm-3 ml-5 mt-2 mx-auto text-center" role="alert"> Updated Successfully </div>';
    } else {
        $msg = '<div class="alert alert-danger col-sm-3 ml-5 mt-2 mx-auto text-center" role="alert"> Unable to Update </div>';
    }
    }
}
?>



            <div class="col-sm-9 col-md-10 mt-5">
            <?php if (isset($msg)) {
                echo $msg;
            } ?>
            <form class="mx-5" action="" method="POST">
                <br><br><h2 class="text-center text-danger"><b>Today Exchange Rate : </b></h2><br><br>
                <div class="form-row justify-content-center">
                    <div class="form-group ml-4 col-md-2 text-center">
                        <label for="usd"><h3 class="text-secondary"><b>United States Dollar (USD) :</b></h3></label>
                        <input type="number" class="form-control text-center" id="usd" name="usd" placeholder="$ 1.00" readonly>
                    </div>

                    <div class="form-group mr-4 col-md-2 text-center">
                        <label for="etb"><h3 class="text-secondary"><b> = </b></h3></label>
                    </div>

                    <div class="form-group mr-4 col-md-2 text-center">
                        <label for="etb"><h3 class="text-secondary"><b>Ethiopian Birr (ETB) :</b></h3></label>
                        <input type="text" class="form-control text-center" id="etb" name="etb" 
                            oninput="this.style.fontWeight='bold'; validateNumberInput(this);"
                            placeholder="<?php echo $rName; ?>" min="0" value="<?php echo $etb; ?>" step=any>

                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" name="update" class="d-print-none btn btn-danger" id="update" data-printable="false">Update</button>
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
<script>
    function validateNumberInput(input) {
        // Remove non-numeric and non-dot characters using a regular expression
        input.value = input.value.replace(/[^0-9.]/g, '');

        // Make the entered text bold
        input.style.fontWeight = 'bold';
    }

</script>

<!-- <input type="number" class="form-control text-center" id="etb" name="etb" oninput="this.style.fontWeight='bold'; validateNumberInput(this)" step="any">

<input name="basic_salary" type="number" id="basic_salary"
                    class="form-control input-sm {{ $errors->has('basic_salary') ? ' is-invalid' : '' }}"
                    value="{{ old('basic_salary') ?? $payroll->basic_salary }}" onfocusout="validateBasicSalary()"
                    min="0" value="0" step="any"> -->


