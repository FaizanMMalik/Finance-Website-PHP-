
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
  <title>KSN- Update Four Man</title>
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
       if (isset($_POST['submit']))
       {
        $query = "select * from fourman where id='$_POST[id]'";
       }
       else
       {
        $query = "select * from fourman where id='$_GET[id]'";
       }
       $result = @mysqli_query($conn, $query);
       if($row = @mysqli_fetch_assoc($result))
       {

       }
       else
       {
           mysqli_close($conn);
           echo "error";
           echo "<script>window.location.replace('fourman.php');</script>";
         exit;
       }
      if (isset($_POST['submit'])) {
        $sql = "UPDATE `fourman` SET `name`='$_POST[name]',`contactNumber`='$_POST[contactNumber]' WHERE id='$_POST[id]'";
        echo $sql;
          mysqli_query($conn, $sql);
          mysqli_close($conn);
          echo "updated";
          echo "<script>window.location.replace('fourMan.php');</script>";
          exit;
        
    }
    
    ?>
<div>
 <br>
    <h2 style="color:yellow" >Update Four Man</h2>
    <form action="fourManUpdate.php" method="post">
    <div hidden>
      <label>id</label>
        <input type="text" name="id" id="id" value="<?php echo $row['id'];?>">
        
      </div>
    <div>
    
        <input type="text" name="name" id="name"   placeholder="Name" required value="<?php echo $row['name'];?>">
        
      </div>
      <div>
      
        <input type="text" name="contactNumber"  placeholder="Contact Number" id="contactNumber" required value="<?php echo $row['contactNumber'];?>">
        
      </div>
      
      <br>
      <input type="submit" class="button-63" name="submit" value="Update">
    </form>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br>
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





