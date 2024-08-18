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

<body class="bg-light">
 <!-- Top Navbar -->
    <nav class="navbar navbar-dark fixed-top bg-danger flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="staffpage.php">
            Quit Company Payroll Management System</a>
            
    </nav>

 <!-- Side Bar -->
    <div class="container-fluid mb-5 " style="margin-top:40px;">
        <div class="row">
            <nav class="col-sm-2 bg-light sidebar py-5 d-print-none no-print">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'dashboard') { echo 'active'; } ?> " href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'Staff profile') { echo 'active'; } ?>" href="staffpage.php">
                                <i class="fas fa-user"></i>
                                Profile <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'addemployee') { echo 'active'; } ?>" href="addemployee.php">
                                <i class="fas fa-user-plus"></i>
                                Add Employee Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'exchangerate') { echo 'active'; } ?>" href="ExchangeRate.php">
                            <i class="fas fa-dollar-sign fs-3"></i>
                                 Exchange Rate
                            </a>
                        </li>
                        <li class="nav-item">
                             <a class="nav-link <?php if(PAGE == 'stafflist') { echo 'active'; } ?>" href="Stafflist.php">
                             <i class="fas fa-user"></i>
                                    List Of Staff
                             </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'generatereport') { echo 'active'; } ?>" href="Generatereport.php">
                                <!--<i class="fas fa-table"></i>-->
                                <i class="fas fa-file-alt"></i>
                                 Generate Report
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'upload') { echo 'active'; } ?>" href="Upload.php">
                                <i class="fas fa-upload"></i>
                                 Upload
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'report') { echo 'active'; } ?>" href="PayrollReportView.php">
                                <i class="fas fa-table"></i>
                                 View Report
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            
            