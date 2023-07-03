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
  <title>KSN- Add Expense</title>
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
  <br><br><br><br>
  <!-- End Header -->

  <section id="hero" class="hero">
  
<center>
<?php
      if (isset($_POST['submit'])) {
 
       
        include 'database.php';
        $sql = "INSERT INTO `purchase`(`assetsId`, `amount`, `date`,description,partnerId) VALUES ('$_POST[assets]','$_POST[amount]','$_POST[date]','$_POST[description]','$_POST[partner]')";
        
          mysqli_query($conn, $sql);
          mysqli_close($conn);
          echo "<script>window.location.replace('purchase.php');</script>";
          exit;
    }
    ?>
<div>
 
    <h2 style="color:yellow" >Add Expense</h2>
    <form action="purchaseAdd.php" method="post" onsubmit="return submitData()">
    <div>
      <!--<label style="color:yellow" >Date</label>-->
        <input type="date" style=' width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;' name="date" placeholder="Date" id="date" value="<?php if(isset($_POST['date'])){echo $_POST['date'];} else{echo "";}?>">
      </div>
      
    <div>
       <!--<label style="color:yellow" >Partner</label>-->
  <?php
   include 'database.php';
  $sql = "SELECT id,name FROM partner where isActive='1'";
  
  $result = mysqli_query($conn, $sql);
  
  // Check the result
  
  if (mysqli_num_rows($result) > 0) {
    echo "
    
    <select  style=' width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;'  name='partner' required>
     <option disabled='disabled' selected='selected' style='display:none;'>Select a Partner</option>"
    ;
    // Loop through the result
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<option value='$row[id]'";
      if(isset($_GET["id"])&&$row["id"]==$_GET["id"])
      {
        echo " selected";
      }
      echo ">" . $row["name"] . "</option>";
    }
    echo "</select>";
  }
  // Close the connection
  mysqli_close($conn);
?>
      <!--<label style="color:yellow" >Assets</label>-->
      <?php
  include 'database.php';
  // Write the SQL query
  $sql = "SELECT id,name FROM assets where isActive='1'";
  
  // Execute the SQL query
  $result = mysqli_query($conn, $sql);
  
  // Check the result
  if (mysqli_num_rows($result) > 0) {
    echo "<select style=' width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;' name='assets' id='assets' required>
     <option disabled='disabled' selected='selected' style='display:none;'>Select an Asset</option>
    ";
    // Loop through the result
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<option value='$row[id]'>" . $row["name"] . "</option>";
    }
    echo "</select>";
  }
  echo "<br>";
  ?>


      </div>
    
      <div>
      <!-- <label>Amount</label> -->
      <!--<label style="color:yellow" >Amount</label>-->
        <input type="number" name="amount" placeholder="Amount" style=' width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;'  required value="<?php if(isset($_POST['amount'])){echo $_POST['amount'];} else{echo "";}?>">
        
      </div>
      <div>
      <!-- <label>Description</label> -->
      <!--<label style="color:yellow" >Description</label>-->
      <textarea rows="1" style=' width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;' cols="20" placeholder="Description" name="description" required></textarea>
      </div>
    <br><br>
      <input type="submit" name="submit" value="Save" class="button-63">
    </form>
  </div>
  
<br><br><br><br><br><br><br><br>

















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




  function submitData() {
  try {
  var list = document.getElementById("assets");
var count=list.options.length;
    return true;
} catch (error1) {
  alert("Please Add Assets");
  return false;
}
  }
</script>