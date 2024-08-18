<?php
define('TITLE', 'Dashboard');
define('PAGE', 'dashboard');
include('includes/header.php');
include('dbConnection.php');
session_start();
if ($_SESSION['is_login']) {
  $rEmail = $_SESSION['rEmail'];
} else {
  echo "<script> location.href='index.php'; </script>";
}

$er = null;
$sqli = "SELECT * FROM exchange_rate";
                           $resulti = $conn->query($sqli);
                           if ($resulti->num_rows == 1) {
                             $rowi = $resulti->fetch_assoc();
                             $er = $rowi["ETB"];
                           }

 $sql = "SELECT * FROM staff";
 $result = $conn->query($sql);
 $totaltech = $result->num_rows;

 $sql = "SELECT * FROM complaints";
 $result = $conn->query($sql);
 $total = $result->num_rows;

 $sql = "SELECT SUM(CASE WHEN PaymentCurrency = 'USD' THEN BasicSalary * $er ELSE BasicSalary END) AS totalBasicSalary FROM staff";
$resultt = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $resultt->fetch_assoc();
    $totalBasicSalary = $row['totalBasicSalary'];
}
?>
<div class="col-sm-9 col-md-10">
  <div class="row mx-5 text-center">
    <div class="col-sm-4 mt-5">
      <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
        <div class="card-header"><h1><span class="fas fa-dollar-sign fs-3 text-white"></span></h1> Total Basic Salary </div>
        <div class="card-body">
          <h4 class="card-title">
            <?php echo number_format($totalBasicSalary); ?>
          </h4>
          <a class="btn text-white" href="stafflist.php">View</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4 mt-5">
    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header"><h1> <span class="fa fa-user-tie fs-3 text-white"></span></h1> Number of Employee</div>
        <div class="card-body">
          <h4 class="card-title">
            <?php echo $totaltech; ?>
          </h4>
          <a class="btn text-white" href="stafflist.php">View</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4 mt-5">
      <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
        <div class="card-header"> <span class="fas fa-exclamation-triangle fa-4x text-danger"></span><br> Number of Complains</div>
        <div class="card-body">
          <h4 class="card-title">
            <?php echo $total; ?>
          </h4>
          <a class="btn text-white" href="view complains.php">View</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4 mt-5">
      <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header"><h1><span class="fas fa-building fs-3 text-white"></span></h1> Department</div>
        <div class="card-body">
          <h4 class="card-title">
            4
          </h4>
          <a class="btn text-white" href="stafflist.php">View</a>
        </div>
      </div>
    </div>

  </div>
  <div class="mx-5 mt-5 text-center">
    <!--Table-
    <p class=" bg-dark text-white p-2">List of Employee</p> -->
    <?php
//     $sql = "SELECT * FROM staff";
//     $result = $conn->query($sql);
//     if($result->num_rows > 0){
//  echo '<table class="table">
//   <thead>
//    <tr>
//     <th scope="col">Employee ID</th>
//     <th scope="col">Name</th>
//     <th scope="col">Department</th>
//    </tr>
//   </thead>
//   <tbody>';
//   while($row = $result->fetch_assoc()){
//    echo '<tr>';
//     echo '<th scope="row">'.$row["EmployeeID"].'</th>';
//     echo '<td>'. $row["NameOfStaff"].'</td>';
//     echo '<td>'.$row["Department"].'</td>';
//   }
//  echo '</tbody>
//  </table>';
// } else {
//   echo "0 Result";
// }
?>
  </div>
</div>
</div>
</div>
<?php
include('includes/footer.php'); 
?>