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
  <title>KSN- Details</title>
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

  <!-- ======= Header ======= -->
  <?php include 'partial/header.php';?>
  
  <!-- End Header -->
<br><br><br>
  <section id="hero" class="hero">
  
<center>


<?php
       include 'database.php';
        $query = "select * from partner where id='$_GET[id]'";
       $result = @mysqli_query($conn, $query);
       if($row = @mysqli_fetch_assoc($result))
       {

       }
       else
       {
           mysqli_close($conn);
           echo "error";
           echo "<script>window.location.replace('partner.php');</script>";
         exit;
       }
    ?>
<div>
 <br>
    <h2 style="color:orange"><b>Parnter's Detail</b></h2>
    
    
    <div>
      
      <input type="text" disabled placeholder=" Name" name="name" id="name" required value="<?php echo $row['name'];?>">
      
    </div>
    <div>
    
      <input type="text" disabled placeholder=" Username" name="userName" id="userName" required value="<?php echo $row['userName'];?>">
      
    </div>
    <?php
    if($_SESSION['admin']==1)
    {?>
    <div>
 
      <input type="text" disabled placeholder=" Password" name="password" id="password" required value="<?php echo $row['password'];?>">
      
    </div>
    <?php
    }?>
    <div>
    
      <input type="text"  disabled placeholder=" Contact Number" name="contactNumber" required value="<?php echo $row['contactNumber'];?>">
      
    </div>
    
   
    <br>
      <img style='width:20%;' id="preview" src="<?php echo "assets/img/$row[image]";?>">
      <br>
      <input type="checkbox" disabled id="admin" name="admin" value="1" <?php if($row['isAdmin']=="1") {echo "checked";}?>>
      
      <label for="admin" style="color:white">Admin?</label><br>
      <br>

  </div>
    
</center>

  </section>
 <br><br><br><br><br><br>
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











