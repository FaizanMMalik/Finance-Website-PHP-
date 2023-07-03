<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
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
  <title>KSN- Add Assets</title>
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

  <!-- =======================================================
  * Template Name: UpConstruction - v1.3.0
  * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body style="background: linear-gradient(45deg, #49a09d, #5f2c82);">
<center>
  <!-- ======= Header ======= -->
  <?php include 'partial/header.php';?>
  <br>
  <br>
  <br>
  <br>
  <!-- End Header -->

  <section id="hero" class="hero">
  <?php
      if (isset($_POST['submit'])) {
 
       
        include 'database.php';
        $sql = "INSERT INTO `assets`(`name`, `detail`, `isActive`) VALUES ('$_POST[name]','$_POST[detail]','1')";
        
          mysqli_query($conn, $sql);
          mysqli_close($conn);
          echo "<script>window.location.replace('assets.php');</script>";
          //header('Location: assets.php');
          exit;
    }
    ?>
<div>
 
    <h2 style="color:yellow">Add an Asset</h2>
    <br>
    <form action="assetsAdd.php" method="post" enctype="multipart/form-data">
    <div>
    
        <input type="text" placeholder="Name" name="name" id="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} else{echo "";}?>">
        
      </div>
    
      <div>
     
        <input type="text" name="detail" placeholder="Details" value="<?php if(isset($_POST['detail'])){echo $_POST['detail'];} else{echo "";}?>">
        
      </div>
      <br><br>
      <input type="submit" class="button-63" name="submit" value="Save">
      <br><br>
    </form>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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















