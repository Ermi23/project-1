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
 <link rel="stylesheet" href="../css/bootstrap.min.css">

 <!-- Font Awesome CSS -->
 <link rel="stylesheet" href="../css/all.min.css">

 <!-- Custome CSS -->
 <link rel="stylesheet" href="../css/custom.css">

</head>

<body>
 <!-- Top Navbar -->
 <nav class="navbar navbar-dark fixed-top bg-danger p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="Storemanagerprofile.php">Store Manager</a>
 </nav>

 <!-- Side Bar -->
 <div class="container-fluid mb-5" style="margin-top:40px;">
  <div class="row">
   <nav class="col-sm-3 col-md-2 bg-light sidebar py-5 d-print-none">
    <div class="sidebar-sticky">
     <ul class="nav flex-column">
      <li class="nav-item">
      <a class="nav-link <?php if(PAGE == 'StoremanagerProfile') { echo 'active'; } ?>" href="StoremanagerProfile.php">
        <i class="fas fa-user"></i>
        Profile <span class="sr-only">(current)</span>
       </a>
      </li>
   
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'assets') { echo 'active'; } ?>" href="assets.php">
        <i class="fas fa-database"></i>
        Facilities
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'StoreSubmitRequest') { echo 'active'; } ?>" href="StoreSubmitRequest.php">
        <i class="fab fa-accessible-icon"></i>
        Request Form
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'store_view_approved') { echo 'active'; } ?>" href="store_view_approved.php">
        <i class="fas fa-table"></i>
        Approved Request
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'storeworkreport') { echo 'active'; } ?>" href="storeworkreport.php">
        <i class="fas fa-table"></i>
        Generate Report
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'storeupload') { echo 'active'; } ?>" href="storeupload.php">
        <i class="fas fa-upload"></i>
        Upload
       </a>
      </li>
     
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'History') { echo 'active'; } ?>" href="storeHistory.php">
        <i class="fas fa-table"></i>
        History
       </a>
      </li>

      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'storechangepass') { echo 'active'; } ?>" href="storechangepass.php">
        <i class="fas fa-key"></i>
        Change Password
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link" href="../logout.php">
        <i class="fas fa-sign-out-alt"></i>
        Logout
       </a>
      </li>
     </ul>
    </div>
   </nav>