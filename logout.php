<?php
session_start();
$_SESSION['username']="";
echo "<script>window.location.replace('login.php')</script>";
  session_write_close();
  exit;
?>