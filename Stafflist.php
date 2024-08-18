<?php
define('TITLE', 'StaffList');
define('PAGE', 'stafflist');
include('includes/header.php'); 
include('dbConnection.php');
session_start();
if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['rEmail'];
} 
else {
    echo "<script> location.href='index.php'; </script>";
}
$id = null;
$er = null;
$sqli = "SELECT * FROM exchange_rate";
                           $resulti = $conn->query($sqli);
                           if ($resulti->num_rows == 1) {
                             $rowi = $resulti->fetch_assoc();
                             $er = $rowi["ETB"];
                           }
?>
<div class="col-sm-9 col-md-10 mt-5 text-center">
  <!--Table-->
  <p class="bg-dark text-white p-2">List of Employee</p>
  <?php
    $sql = "SELECT * FROM staff";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo '<table class="table">
            <thead>
                <tr>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">Basic Salary</th>
                    <th scope="col">Payment Currency</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';
        while($row = $result->fetch_assoc()){
            echo '<tr>';
            echo '<th scope="row">'.$row["EmployeeID"].'</th>';
            echo '<td>'. $row["NameOfStaff"].'</td>';
            echo '<td>'.$row["Department"].'</td>';

            if ($row['PaymentCurrency'] == 'USD') {
                $row['BasicSalary'] *= $er;}

            echo '<td>'.number_format($row["BasicSalary"]).'</td>';
            echo '<td>'.$row["PaymentCurrency"].'</td>';
            echo '<td>
                <form action="updateemployeedetail.php" method="POST" class="d-inline">
                    <input type="hidden" name="id" value='. $row["EmployeeID"] .'>
                    <button type="submit" class="btn btn-info mr-3" name="view" value="View">
                        <i class="fas fa-pen"></i>
                    </button>
                </form>  
                <form action="" method="POST" class="d-inline">
                    <input type="hidden" name="id" value='. $row["EmployeeID"] .'>
                    <button type="submit" class="btn btn-danger" name="delete" value="Delete">
                    <i class="far fa-trash-alt"></i>
                    </button>
                    </form>
  
            </td>
            </tr>';
        }
        echo '</tbody>
        </table>';
    } else {
        echo "0 Result";
    }

    if(isset($_REQUEST['delete'])){
        $id = $_REQUEST['id'];
        $sql = "DELETE FROM employee WHERE EmployeeID = '$id'";
        $sqla = "DELETE FROM staff WHERE EmployeeID = '$id'";
            if($conn->query($sql) === TRUE && $conn->query($sqla) === TRUE){
                //echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
            } else {
              echo "Unable to Delete Data";
            }
        
    }


?>
</div>
</div>
<?php 
$sql = "SELECT SUM(CASE WHEN PaymentCurrency = 'USD' THEN BasicSalary * $er ELSE BasicSalary END) AS totalBasicSalary FROM staff";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalBasicSalary = $row['totalBasicSalary'];
    $msg = "<div class='alert alert-success col-sm-2 ml-5 mt-2 mx-auto' role='alert'>Total Basic Salary =" . number_format($totalBasicSalary) . "   ETB </div>";

} else {
    $msg = "<div class='alert alert-danger col-sm-2 ml-5 mt-2 mx-auto' role='alert'>No records found.</div>";
}

// Output the $msg variable wherever you want in your HTML
echo $msg;
?>

<div>
    <a class="btn btn-danger box" href="addemployee.php">Registration</a>
</div>
</div>

<?php
include('includes/footer.php'); 
?>