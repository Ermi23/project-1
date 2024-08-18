<?php
    define('TITLE', 'complains');
    define('PAGE', 'complains');
    include('includes/header1.php');
    include('dbConnection.php');
    session_start();
    if ($_SESSION['is_login']) {
        $rEmail = $_SESSION['rEmail'];
    } else {
        echo "<script> location.href='index.php'; </script>";
    }

    $currentDate = date("w");
    $currentMonth = date("M");
    $currentYear = date("Y");
    $NameOfStaff = null;
    $Email = null;
    $Message = null;

    $sql = "SELECT * FROM employee WHERE Email='$rEmail'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $rID = $row["EmployeeID"];
        $rpass = $row["password"];
    }
    $sqla = "SELECT * FROM staff WHERE EmployeeID='$rID'";
    $result = $conn->query($sqla);
    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $NOS = $row["NameOfStaff"];
    }

    if (isset($_REQUEST['submit'])) {
        $Email = $_REQUEST['email'];
        $Message = $_REQUEST['message'];

        $sqla = "SELECT * FROM staff WHERE EmployeeID='$rID'";
        $result = $conn->query($sqla);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $NOS = $row["NameOfStaff"];
        }

        $sql = "INSERT INTO `complaints`(`Name`, `Email`, `Discription`, `Datee`) 
          VALUES ('$NOS', '$rEmail', '$Message', '$currentDate - $currentMonth - $currentYear')";

        if ($conn->query($sql) === TRUE) {
            // Message displayed on form submit success
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2 mx-auto text-center" role="alert"> Your complaint has been submitted successfully. </div>';
        } else {
            // Message displayed on form submit failure
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert" "mx-auto"> Unable to Send </div>';
        }
    }
?>

<div class="container mt-5">
        <h2 class="text-center">Compliant Registration </h2>
        <p class="text-center">Quit company </p>
        <form>
        <?php if (isset($msg)) {
            echo $msg;
            } ?>
            <div class="form-group">
                <label for="name"><strong>Your Name</strong></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo $NOS; ?>" value = "<?php $NOS; ?>" readonly>

            </div>
            <div class="form-group">
                <label for="email"><strong>Email address</strong></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $rEmail; ?>" value = "<?php $rEmail; ?>" readonly>


            </div>
            <div class="form-group">
                <label for="message"><strong>Complaint Discription</strong></label>
                <textarea class="form-control" id="message" name="message" rows="4" placeholder="Enter your Complaint Discription"></textarea>
            </div>
            <button type="submit" name="submit" id="submit" class="btn btn-danger d-block mx-auto">Submit</button>

        </form>
</div>

<?php
    include('includes/footer.php'); 
    $conn->close();
?>