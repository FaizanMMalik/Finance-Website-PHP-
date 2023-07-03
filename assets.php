<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  //header('Location: login.php');
  exit;
}
$current="category";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="assets/img/ksnlogo.jpg" rel="icon">
  <title>KSN- Assets</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/btn.css" rel="stylesheet">
  <link href="assets/css/tabled.scss" rel="stylesheet">

  <!-- =======================================================
  * Template Name: UpConstruction - v1.3.0
  * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include 'partial/header.php';?>
  
  <!-- End Header -->

  <section id="hero" class="hero">
  
<br><br><br><br><center>
<h2 style="color:orange"><b>ASSETS</b></h2>
<div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 lg:-mx-8 375:h-[26rem] 412:h-[23rem] 390:h-[24.5rem] 360:h-[26rem] 820:h-[53rem] 768:h-[42rem] 540:h-64 h-[32.5rem]" style="overflow-y:scroll;">
<table style="overflow-x:auto;" >

<?php if($_SESSION['admin']==1)
    {
      echo "<tr><td colspan='4'><a href='assetsAdd.php' class='button-63'>Add Assets</a></td></tr>";
    }?>


  <tr>
    <th style='color:black'>S.No</th>
    <th style='color:black'>Name</th>
    <?php
    if($_SESSION['admin']==1)
    {
      echo "<th style='color:black'>Update</th>
      <th style='color:black'>Delete</th>";
    }?>
    
  </tr>
  <?php
  include 'database.php';
  $query = "select * from assets where isActive=1";
  $result = @mysqli_query($conn, $query);
  if(!$result)
  {
    echo 'There is an issue with the database';
    exit;
}
$i=0;
 while($row = @mysqli_fetch_assoc($result))
 {
    $i=$i+1;
    echo "<tr>
    <td style='color:black' >" . $i . "</td>

    <td><a  style='color:black' href='partnerDetailInvestment.php?assetid=$row[id]'>$row[name]</a></td>";
    if($_SESSION['admin']==1)
    {
        echo "<td><a href='assetsUpdate.php?id=$row[id]'>Update</a></td>
        <td><a href='assetsDelete.php?id=$row[id]'>Delete</a></td>";
    }
    echo "</tr>";
 }
 mysqli_close($conn);
    ?>
    
</table>
</div>
</center>
  </section>
 

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>











