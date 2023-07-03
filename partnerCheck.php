<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}
include 'database.php';
$sql = "select * from partner where username like '$_GET[username]'";
$result = @mysqli_query($conn, $sql);
$i=0;
if($row = @mysqli_fetch_assoc($result))
{
  echo "1";
}
else
{
  echo "0";
}
  mysqli_close($conn);
 
?>