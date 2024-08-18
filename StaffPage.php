<?php
define('TITLE', 'Staff Profile');
define('PAGE', 'Staff profile');
include('includes/header.php'); 
include('dbConnection.php');
 session_start();
 if($_SESSION['is_login']){
  $rEmail = $_SESSION['rEmail'];
 } else {
  echo "<script> location.href='index.php'; </script>";
 }

 $sql = "SELECT * FROM requesterlogin_tb WHERE r_email='$rEmail'";
 $result = $conn->query($sql);
 if($result->num_rows == 1){
 $row = $result->fetch_assoc();
 $rName = $row["r_name"];
 $rpass = $row["r_password"];
 }

 if(isset($_REQUEST['nameupdate'])){
  if(($_REQUEST['rName'] == " " || $_REQUEST['passupdate'] == " ")){
   // msg displayed if required field missing
   $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   $rName = $_REQUEST["rName"];
   $rPass = $_REQUEST['rPassword'];
   $sql = "UPDATE requesterlogin_tb SET r_name = '$rName' , r_password = '$rPass' WHERE r_email = '$rEmail'";
   if($conn->query($sql) == TRUE){
   // below msg display on form submit success
   $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
   } else {
   // below msg display on form submit failed
   $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
      }
    }
   }
?>
<div class="col-sm-4 mt-5">
  <form class="mx-5" method="POST">
    <div class="form-group">
      <label for="inputEmail">Email</label>
      <input type="email" class="form-control" id="inputEmail" value=" <?php echo $rEmail ?>" readonly>
    </div>
    <div class="form-group">
      <label for="inputName">Name</label>
      <input type="text" class="form-control" id="inputName" name="rName" value=" <?php echo $rName ?>">
    </div>
    <div class="form-group">
      <label for="inputPassword">Password</label>
      <input type="password" class="form-control" id="inputnewpassword" name="rPassword" placeholder="*********">
    </div>
    <button type="submit" class="btn btn-danger" name="nameupdate">Update</button>
    <?php if(isset($passmsg)) {echo $passmsg; } ?>
  </form>
</div>
</div>
</div>
<?php
include('includes/footer.php'); 
?>