<?php
define('TITLE', 'Dashboard');
define('PAGE', 'dashboard');
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
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Description</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>';
  $sql = "SELECT * FROM complaints ORDER BY ID DESC";
  $result = $conn->query($sql);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $i++;
      // rest of your code...
  ?>
  <tr>
    <td scope="row"><?php echo $i?></td>
    <td scope="row"><?php echo $row["Name"]?></td>
    <td scope="row"><?php echo $row["Email"]?></td>
    <td scope="row"><?php echo $row["Discription"]?></td>
    <td scope="row"><?php echo $row["Datee"]?></td>
    </tr>
    <?php
  }
   echo '</tbody> </table>';}
  else {
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

