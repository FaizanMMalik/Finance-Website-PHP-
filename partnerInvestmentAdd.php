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
  <title>KSN- Add</title>
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

<body  style="background: linear-gradient(45deg, #49a09d, #5f2c82);">

  <!-- ======= Header ======= -->
  <?php include 'partial/header.php';?>
  
  <!-- End Header -->
<br><br><br><br>
  <section id="hero" class="hero">
  
<center>

<?php
      if (isset($_POST['submit'])) {
 
       
        include 'database.php';
        $sql = "INSERT INTO `partnerinvestment`(`partnerId`, `investment`, `date`) VALUES ('$_POST[partner]','$_POST[investment]','$_POST[date]')";
        
          mysqli_query($conn, $sql);
          mysqli_close($conn);
          echo "<script>window.location.replace('statistics.php');</script>";
          exit;
    }
    ?>
<div>
 
    <h2 style="color:yellow" >Add Investment</h2>
    <form action="partnerInvestmentAdd.php" method="post">
    <div>
      <label style="color:yellow" >Partner</label>
      <?php
  include 'database.php';
  $sql = "SELECT id,name FROM partner where isActive='1'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo "<select style=' width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;' name='partner'>";
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<option value='$row[id]'>" . $row["name"] . "</option>";
    }
    echo "</select>";
  } else {
    echo "0 results";
  }
  
  // Close the connection
  mysqli_close($conn);
?>

      </div>
    
      <div>
      <label style="color:yellow">Investment</label>
        <input type="number" style=' width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;'  name="investment" required value="<?php if(isset($_POST['investment'])){echo $_POST['investment'];} else{echo "";}?>">
        
      </div>
     
      <div>
      <label style="color:yellow" >Date</label>
        <input type="date" style=' width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;' name="date" id="date" value="<?php if(isset($_POST['date'])){echo $_POST['date'];} else{echo "";}?>">
      </div>
      <input type="submit" name="submit" class="button-63" value="Save">
    </form>
  </div>
     

















</center>
  </section>
 


  
  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

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












    




    
  <script>
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1;
  var yyyy = today.getFullYear();

  if(dd<10) {
      dd='0'+dd;
  } 

  if(mm<10) {
      mm='0'+mm;
  } 

  today = yyyy+'-'+mm+'-'+dd;

  document.getElementById("date").value = today;
</script>