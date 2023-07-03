<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}
include 'database.php';
$sql = "DELETE FROM `purchase` WHERE id='$_GET[id]'";

  mysqli_query($conn, $sql);
  mysqli_close($conn);
  echo "<script>window.location.replace('purchase.php');</script>";
  exit;
?>