<?php
define('TITLE', 'Report');
define('PAGE', 'report');
include('includes/header.php');
include('dbConnection.php'); 
session_start();
$rtype=null;
$i = 0;
if ($_SESSION['is_login']) {
  $rEmail = $_SESSION['rEmail'];
} else {
  echo "<script> location.href='index.php'; </script>";
}
?>
<div class="col-sm-9 col-md-10 mt-5">
  <?php 

  echo '<table class="table">
  <thead>
    <tr>
      <th scope="col">File ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Report Type</th>
      <th scope="col">Description</th>
      <th scope="col">Date</th>
      <th scope="col">File</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>';
  $sql = "SELECT * FROM report_tb ORDER BY report_id DESC";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $i++;
      if($row["Payroll Type"] == 'PRS' ){
          $rtype = "Payroll Sheet";
      }
      elseif($row["Payroll Type"] == 'BPS' ){
          $rtype = "Bank Payment Sheet";
      }
      elseif($row["Payroll Type"] == 'DP' ){
          $rtype = "Department Payroll";
      }
      elseif($row["Payroll Type"] == 'ITR' ){
          $rtype = "Income Tax Return";
      }
      elseif($row["Payroll Type"] == 'JBET' ){
          $rtype = "Journal Entry By Department";
      }
      elseif($row["Payroll Type"] == 'PR' ){
        $rtype = "Pension Return";
    }
    elseif($row["Payroll Type"] == 'JR' ){
      $rtype = "Journal Report";
  }
      // rest of your code...
  ?>
  <tr>
    <td scope="row"><?php echo $i?></td>
    <td scope="row"><?php echo $row["fname"]?></td>
    <td scope="row"><?php echo $row["Email"]?></td>
    <td scope="row"><?php echo $rtype ?></td>
    <td scope="row"><?php echo $row["desc"]?></td>
    <td scope="row"><?php echo $row["datee"]?></td>
    <td scope="row"><?php echo $row['pdf']?></td>
    <td>
    <form action="" method="POST" class="d-inline">
      <input type="hidden" name="id" value='<?php echo $row["report_id"]; ?>'>
      <a href="PayrollReports/<?php echo $row["pdf"]; ?>" target="_action">
        <button type="button" class="btn btn-danger" name="view" value="view">View</button>
      </a>
    </form>
    </td>
    
    
    </tr><?php
   }
   echo '</tbody> </table>';
  } else {
    echo "0 Result";
  }
  // if(isset($_REQUEST['remove'])){
  //   $sql = "UPDATE report_tb SET seen='seen' WHERE report_id = {$_REQUEST['id']}";
  //   if($conn->query($sql) === TRUE){
  //     // echo "Record Deleted Successfully";
  //     // below code will refresh the page after deleting the record
  //     echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
  //     } else {
  //       echo "Unable to Remove Data";
  //     }
  //   }
  ?>
</div>
</div>
</div>

<?php
include('includes/footer.php'); 
?>

