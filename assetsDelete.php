<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}

include 'database.php';
$sql = "update assets set isactive='0' where id='$_GET[id]'";

  mysqli_query($conn, $sql);
  mysqli_close($conn);
  echo "<script>window.location.replace('assets.php');</script>";
  //header('Location: assets.php');
  exit;
?>