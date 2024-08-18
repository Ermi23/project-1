<?php 
define('TITLE', 'Update');
define('PAGE', 'update');
include('includes/header.php');
include('dbConnection.php');
session_start();
if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='index.php'; </script>";
}

if(isset($_REQUEST['delete'])){
        $id = $_POST['EmployeeID'];
        $sql = "DELETE FROM employee WHERE EmployeeID = '$id'";
        $sqla = "DELETE FROM staff WHERE EmployeeID = '$id'";
            if($conn->query($sql) === TRUE && $conn->query($sqla) === TRUE){
                echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
                header("Location: stafflist.php"); exit;;
            } 
        
    }
?>