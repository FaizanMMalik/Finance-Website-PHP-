
<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}
$current="partner";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="assets/img/ksnlogo.jpg" rel="icon">
  <title>KSN- Add Partners</title>
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
  
    
  <?php
      if (isset($_POST['submit'])) {
 
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "assets/img/" . $filename;
        $admin=0;
        if(isset($_POST['admin']))
        {
          $admin=1;
        }
        include 'database.php';
        $sql = "select * from partner where username like '$_POST[userName]'";
$result = @mysqli_query($conn, $sql);
$i=0;
if($row = @mysqli_fetch_assoc($result))
{
  echo "<script>
  window.alert('UserName Already Exits');
  </script>";
}
else
{
        $sql = "INSERT INTO `partner`(`name`, `userName`, `password`, `contactNumber`, `image`, `isAdmin`, `isActive`) VALUES ('$_POST[name]','$_POST[userName]','$_POST[password]','$_POST[contactNumber]','$filename','$admin','1')";
        
        if (move_uploaded_file($tempname, $folder)) {
          mysqli_query($conn, $sql);
          mysqli_close($conn);
          echo "<script>window.location.replace('partner.php');</script>";
          exit;
        }
      }
        mysqli_close($conn);
    }
    ?>
<div>
 <br>
 <center>
    <h2 style="color:yellow">Add Parnter </h2>
  </center>
    <br>
    <form action="partnerAdd.php" method="post" enctype="multipart/form-data">
    <center>
    <div>
    
        <input type="text" placeholder=" Name"name="name" id="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} else{echo "";}?>">
        
      </div>
      <br>
      <div>
      
        <input type="text" placeholder=" Username" name="userName" id="userName" value="<?php if(isset($_POST['userName'])){echo $_POST['userName'];} else{echo "";}?>" required>
        <input type="text" id="userName1" hidden>
      </div>
      <br>
      <div>

        <input type="password"  placeholder=" Password" name="password" id="password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} else{echo "";}?>">
        
      </div>
      <br>
      <div>
      
        <input type="text" placeholder=" Contact Number" name="contactNumber" value="<?php if(isset($_POST['contactNumber'])){echo $_POST['contactNumber'];} else{echo "";}?>">
        
      </div>
      <br>
      <input type="file" placeholder=" Image" accept="image/*" name="image"  required>
      <br>
        <img style='width:20%' id="preview">
        <input type="checkbox" style="" id="admin" name="admin" value="1">
        <label for="admin" style="color:white">Admin</label><br>
        <!-- <div class="checkbox-wrapper-6">
  <input class="tgl tgl-light" type="checkbox" id="admin" name="admin" value="1"/>
  <label class="tgl-btn" for="admin">
</div> -->
        <br><br>
      <input type="submit"  name="submit" value="Save" class="button-63">
      <br><br><br>
      <center>
    </form>
  </div>

  

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
  <script src="assets/js/jquery-3.6.0.min.js"></script>

</body>

</html>





<script>
      const imageSelector = document.getElementById("image");
      const imagePreview = document.getElementById("preview");

      imageSelector.addEventListener("change", () => {
        const selectedFile = imageSelector.files[0];
        if (selectedFile) {
          const reader = new FileReader();
          reader.addEventListener("load", () => {
            imagePreview.src = reader.result;
          });
          reader.readAsDataURL(selectedFile);
        }
      });
</script>






  