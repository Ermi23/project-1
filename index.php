<?php
include('dbConnection.php');
session_start();
if(!isset($_SESSION['is_login'])){
  if(isset($_REQUEST['rEmail'])){
    $rEmail = mysqli_real_escape_string($conn,trim($_REQUEST['rEmail']));
    $rPassword = mysqli_real_escape_string($conn,trim($_REQUEST['rPassword']));
    $sql = "SELECT r_email, r_password FROM requesterlogin_tb WHERE r_email='".$rEmail."' AND r_password='".$rPassword."' limit 1";
    $sqla = "SELECT Email, Password FROM employee WHERE Email='".$rEmail."' AND Password='".$rPassword."' limit 1";
    //$sqlb = "SELECT r_email, r_password FROM experts WHERE r_email='".$rEmail."' AND r_password='".$rPassword."' limit 1";
    //$sqlc = "SELECT r_email, r_password FROM storemanager WHERE r_email='".$rEmail."' AND r_password='".$rPassword."' limit 1";
   
    $result = $conn->query($sql);
    $resulta = $conn->query($sqla);
    //$resultb = $conn->query($sqlb);
    //$resultc = $conn->query($sqlc);
  
    if($result->num_rows == 1){
      
      $_SESSION['is_login'] = true;
      $_SESSION['rEmail'] = $rEmail;
      // Redirecting to RequesterProfile page on Correct Email and Pass
      echo "<script> location.href='Dashboard.php'; </script>";
      exit;
    } else {
      $msg = '<div class="alert alert-warning mt-2" role="alert"> Enter Valid Email and Password </div>';
    }

    //addition code
    if($resulta->num_rows == 1){
      
      $_SESSION['is_login'] = true;
      $_SESSION['rEmail'] = $rEmail;
      // Redirecting to expertheadProfile page on Correct Email and Pass
      echo "<script> location.href='Employeeprofile.php'; </script>";
      exit;
    } else {
      $msg = '<div class="alert alert-warning mt-2" role="alert"> Enter Valid Email and Password </div>';
    }


    //addition code
    /*if($resultb->num_rows == 1){
      
      $_SESSION['is_login'] = true;
      $_SESSION['rEmail'] = $rEmail;
      // Redirecting to experts Profile page on Correct Email and Pass
      echo "<script> location.href='ExpertsProfile.php'; </script>";
      exit;
    } else {
      $msg = '<div class="alert alert-warning mt-2" role="alert"> Enter Valid Email and Password </div>';
    }
   
    
      //addition code
      if($resultc->num_rows == 1){
      
        $_SESSION['is_login'] = true;
        $_SESSION['rEmail'] = $rEmail;
        // Redirecting to store Manager Profile page on Correct Email and Pass
        echo "<script> location.href='StoremanagerProfile.php'; </script>";
        exit;
      } else {
        $msg = '<div class="alert alert-warning mt-2" role="alert"> Enter Valid Email and Password </div>';
      }*/

      //addition code
  


  }
} else {
  echo "<script> location.href='index.php'; </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/all.min.css">

    <style>
        
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 100px;
            height: auto;
        }
    </style>
    <title>Login</title>
  </head>

  <body>
    <div class="mb-3 text-center mt-5" style="font-size: 30px;">
      <!--<i class="fas fa-stethoscope"></i>-->
      <span><b>LOGIN</b></span>
    </div>
    <p class="text-center" style="font-size: 20px;">  

        <!--<i class="fas fa-user-secret text-danger"></i>-->
    </p>
    <div class="container-fluid mb-5">
      <div class="row justify-content-center custom-margin">
        <div class="col-sm-6 col-md-4">
            
            <div class="logo">
                <img src="images/logo1.jpg" alt="Company Logo">
            </div>
          

          <form action="" class="shadow-lg p-4" method="POST">
          <?php if(isset($msg)) {echo $msg; } ?>
            <div class="form-group">
              <i class="fas fa-user"></i><label for="email" class="pl-2 font-weight-bold">Email</label><input type="email"
                class="form-control" placeholder="Enter Email" name="rEmail">
              <!--Add text-white below if want text color white-->
              
            </div>
            <div class="form-group">
              <i class="fas fa-key"></i><label for="pass" class="pl-2 font-weight-bold">Password</label><input type="password"
                class="form-control" placeholder="Enter Password" name="rPassword">
            </div>
            <button type="submit" class="btn btn-outline-danger mt-3 btn-block shadow-sm font-weight-bold">Login</button>
            
          </form>
          <!--<div class="text-center"><a class="btn btn-info mt-3 shadow-sm font-weight-bold" href="../index.php">Back
              to Home</a></div>-->
        </div>
      </div>
    </div>

    <!-- Boostrap JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.min.js"></script>
  </body>

</html>