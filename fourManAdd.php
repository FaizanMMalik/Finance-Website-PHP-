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
  <title>KSN- Add Four Man</title>
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
<br><br><br><br>
  <section id="hero" class="hero">
  
<center>




<?php
      if (isset($_POST['submit'])) {
 
       
        include 'database.php';
        $sql = "INSERT INTO `fourman`(`contactNumber`, `name`) VALUES ('$_POST[contactNumber]','$_POST[name]')";
        
          mysqli_query($conn, $sql);
          mysqli_close($conn);
          echo "<script>window.location.replace('fourMan.php');</script>";
          exit;
    }
    ?>
<div>
 
    <h2 style="color:yellow">Add ForeMan</h2>
    <form action="fourManAdd.php" method="post">
      <div>
     
        <input type="text" name="name" placeholder="Name" required value="<?php if(isset($_POST['name'])){echo $_POST['name'];} else{echo "";}?>">
        
      </div>
      <div>
     
        <input type="text" name="contactNumber"placeholder="Contact Number"  required value="<?php if(isset($_POST['contactNumber'])){echo $_POST['contactNumber'];} else{echo "";}?>">
        
      </div>
      
      <br><br><br>
      <input type="submit" class="button-63"name="submit" value="Save">
      <br><br><br><br><br><br><br><br><br><br><br><br>
    </form>
  </div>
      














</center>
  </section>


</body>

</html>








