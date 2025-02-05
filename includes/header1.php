<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>
  <?php echo TITLE ?>
 </title>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="css/bootstrap.min.css">

 <!-- Font Awesome CSS -->
 <link rel="stylesheet" href="css/all.min.css">

 <!-- Custome CSS -->
 <link rel="stylesheet" href="css/custom.css">

</head>

<body>
 <!-- Top Navbar -->
 <nav class="navbar navbar-dark fixed-top bg-danger p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="EmployeeProfile.php">Quit Co. Employee Page</a>
 </nav>

 <!-- Side Bar -->
 <div class="container-fluid mb-5" style="margin-top:40px;">
  <div class="row">
   <nav class="col-sm-3 col-md-2 bg-light sidebar py-5 d-print-none" style="height: 100%;">
    <div class="sidebar-sticky">
     <ul class="nav flex-column">
      <li class="nav-item">
      <a class="nav-link <?php if(PAGE == 'employeeprofile') { echo 'active'; } ?>" href="EmployeeProfile.php">
        <i class="fas fa-user"></i>
        Profile <span class="sr-only">(current)</span>
       </a>
      </li>
      
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'individualreport') { echo 'active'; } ?>" href="IndividualReport.php">
        <i class="fas fa-table"></i>
        Payslips
       </a>
      </li>

      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'complains') { echo 'active'; } ?>" href="complains.php">
        <i class="fas fa-upload"></i>
        Complains
       </a>
      </li>
      
      <!--<li class="nav-item">
        <a class="nav-link <?php if(PAGE == 'complains') { echo 'active'; } ?>" href="complains.php">
          <i class="fas fa-upload"></i>
          Complains
        </a>
      </li>-->

      <li class="nav-item">
       <a class="nav-link" href="logout.php">
        <i class="fas fa-sign-out-alt"></i>
        Logout
       </a>
      </li>
     </ul>
    </div>
   </nav>