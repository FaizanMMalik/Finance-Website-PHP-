<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}
include 'database.php';
$sql = "INSERT INTO `workersalary`(`workerId`, `salary`, `date`) VALUES ('$_GET[id]','$_GET[salary]','$_GET[date]')";

  mysqli_query($conn, $sql);
  mysqli_close($conn);
?>