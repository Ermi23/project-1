<?php
    define('TITLE', 'Employee Profile');
    define('PAGE', 'employeeprofile');
    include('includes/header1.php');
    include('dbConnection.php');
    session_start();
    if ($_SESSION['is_login']) {
        $rEmail = $_SESSION['rEmail'];
    } else {
        echo "<script> location.href='index.php'; </script>";
    }

    $sql = "SELECT * FROM employee WHERE Email='$rEmail'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $rID = $row["EmployeeID"];
        $rpass = $row["password"];
    }
    $sqla = "SELECT NameOfStaff FROM staff WHERE EmployeeID='$rID'";
    $result = $conn->query($sqla);
    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $NOS = $row["NameOfStaff"];
    }

    if(isset($_REQUEST['nameupdate'])){
         $rpass = $_REQUEST["inputnewpassword"];
         $NOS = $_REQUEST["inputName"];
         $sql = "UPDATE staff SET NameOfStaff = '$NOS' WHERE EmployeeID='$rID'";
         $sqla = "UPDATE employee SET password = '$rpass' WHERE EmployeeID='$rID'";
         if($conn->query($sql) == TRUE && $conn->query($sqla) == TRUE){
         // below msg display on form submit success
         $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
         } else {
         // below msg display on form submit failed
         $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
            }
          }
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6">
            <form class="mx-5" method="POST">
                <?php if(isset($passmsg)) {echo $passmsg; } ?>
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" value="<?php echo $rEmail ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="inputName">ID</label>
                    <input type="text" class="form-control" id="inputID" name="inputID" value="<?php echo $rID ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="Text" class="form-control" id="inputName" name="inputName" value="<?php echo $NOS ?>">
                </div>

                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="inputnewpassword" name="inputnewpassword" placeholder = "***********">
                </div>
                <button type="submit" class="btn btn-danger" name="nameupdate">Update</button>
            </form>
        </div>
    </div>
</div>

<?php
    include('includes/footer.php'); 
    $conn->close();
?>