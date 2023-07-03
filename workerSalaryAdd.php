<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}
$current="category";
       include 'database.php';
        
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="assets/img/ksnlogo.jpg" rel="icon">
  <title>KSN- Add Salary</title>
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
        $sql = "INSERT INTO `workersalary`(`workerId`, `salary`, `date`,partnerid,detail) VALUES ('$_POST[id]','$_POST[salary]','$_POST[date]','$_POST[partner]','$_POST[detail]')";
          mysqli_query($conn, $sql);
          mysqli_close($conn);
           echo "<script>history.go(-2);</script>";
          exit;
    }
    $query = "select * from worker where id='$_GET[id]'";
       $result = @mysqli_query($conn, $query);
       if($row = @mysqli_fetch_assoc($result))
       {

       }
       else
       {
           mysqli_close($conn);
           echo "error";
         echo "<script>history.go(-2);</script>";
          exit;
       }
    ?>
<div>
 
    <h2 style="color:yellow">Pay Salary To <?php echo $row['name']?></h2>
    <form action="workerSalaryAdd.php" method="post">
          <div>
     
        <input type="date" name="date" id="date" style="width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;"  value="<?php if(isset($_POST['date'])){echo $_POST['date'];} else{echo "";}?>">
      </div>
    <?php
 $sql = "SELECT id,name FROM partner where isActive='1' order by id desc";
  
 // Execute the SQL query
 $result = mysqli_query($conn, $sql);
 
 // Check the result
 if (mysqli_num_rows($result) > 0) {
   echo "<select style=' width: 80%;
   padding: 12px 20px;
   margin: 8px 0;
   box-sizing: border-box;' name='partner' required>
   <option disabled='disabled' selected='selected' style='display:none;'>Select a Partner</option>";
   // Loop through the result
   while ($rows = mysqli_fetch_assoc($result)) {
     echo "<option value='$rows[id]'>" . $rows["name"] . "</option>";
   }
   echo "</select>";
 }
 // Close the connection
 mysqli_close($conn);
 ?>
    <div hidden>
      <label>id</label>
        <input type="text" name="id" id="id" value="<?php echo $row['id'];?>">
        
      </div>
      
      <div>
     
        <input type="number" name="salary" placeholder="Salary" style="width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;" required value="<?php if(isset($row['salary'])){echo $row['salary'];} else if(isset($_POST['salary'])){echo $_POST['salary'];} else{echo "";}?>">
        
      </div>
      <div>
     
        <input type="text" name="detail" placeholder="Detail" style="width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;" required value="<?php if(isset($_POST['salary'])){echo $_POST['salary'];} else{echo "";}?>">
        
      </div>
    
      <br><br><br>
      <input type="submit" class="button-63"name="submit" value="Save">
      <br><br><br><br><br><br><br><br><br><br><br><br>
    </form>
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