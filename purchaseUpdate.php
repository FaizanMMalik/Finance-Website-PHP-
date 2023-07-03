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
  <title>KSN- Update Expense</title>
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

  <section id="hero" class="hero">
  
<center>


<?php
       include 'database.php';
       if (isset($_POST['submit']))
       {
        $query = "select p.id,p.amount,p.date,p.description,a.name,p.assetsId as assetsid,pa.name as pname,pa.id as pid from purchase p inner join assets a on a.id=p.assetsId inner join partner pa on pa.id=p.partnerId where p.id='$_POST[id]'";
       }
       else
       {
        $query = "select p.id,p.amount,p.date,p.description,a.name,p.assetsId as assetsid,pa.name as pname,pa.id as pid from purchase p inner join assets a on a.id=p.assetsId inner join partner pa on pa.id=p.partnerId where p.id='$_GET[id]'";
       }
       $result = @mysqli_query($conn, $query);
       if($row = @mysqli_fetch_assoc($result))
       {
        
       }
       else
       {
           mysqli_close($conn);
           echo "error";
           echo $query;
           echo "<script>history.go(-2);</script>";
         exit;
       }
      if (isset($_POST['submit'])) {
        $sql = "UPDATE `purchase` SET `assetsId`='$_POST[assets]',`amount`='$_POST[amount]',`date`='$_POST[date]',`description`='$_POST[description]',partnerId='$_POST[partner]' WHERE id='$_POST[id]'";
        
        
          mysqli_query($conn, $sql);
          mysqli_close($conn);
          echo "updated";
          echo "<script>history.go(-2);</script>";
          exit;
        
    }
    mysqli_close($conn);
    ?>
<div><br><br><br><br>
  <h2 style="color:yellow">Update Expense</h2>
  <form action="purchaseUpdate.php" method="post">
    <div hidden>
      <label>id</label>
        <input type="text" name="id" id="id" value="<?php echo $row['id'];?>">
    </div>
     <div>
      <!--<label style="color:yellow">Date</label>-->
        <input type="date" style=' width: 80%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;' name="date" id="date" value="<?php echo $row['date'];?>">
    </div>
      
    <div>
          <?php
            include 'database.php';
    $sql = "SELECT id,name FROM partner where isActive='1'";
  
    // Execute the SQL query
    $result = mysqli_query($conn, $sql);
    
    // Check the result
    if (mysqli_num_rows($result) > 0) {
      echo "<select  style=' width: 80%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;' name='partner'>";
      $select=false;
      while ($rows = mysqli_fetch_assoc($result)) {
        echo "<option value='$rows[id]'";
        if($rows["id"]==$row["pid"])
        {
          echo " selected";
          $select=true;
        }
        echo ">" . $rows["name"] ."</option>";
      }
      if(!$select)
      {
        echo "<option value='$row[pid]' selected>" . $row["pname"] ."</option>";
      }
      echo "</select>";
  }
  
  // Close the connection
  mysqli_close($conn);
?>

        
      <!--<label style="color:yellow">Assets</label>-->
      <?php
  include 'database.php';
  // Write the SQL query
  $sql = "SELECT id,name FROM assets where isActive='1'";
  
  // Execute the SQL query
  $result = mysqli_query($conn, $sql);
  
  // Check the result
  if (mysqli_num_rows($result) > 0) {
    echo "<select  style=' width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;' name='assets'>";
    // Loop through the result
    $select=false;
    while ($rows = mysqli_fetch_assoc($result)) {
      echo "<option value='$rows[id]'";
      if($rows["id"]==$row["assetsid"])
      {
        echo " selected";
        $select=true;
      }
      echo ">" . $rows["name"] ."</option>";
    }
    if(!$select)
    {
      echo "<option value='$row[assetsid]' selected>" . $row["name"] ."</option>";
    }
    echo "</select><br><label style='color:yellow'></label>";
  }
  ?>
    
      <!-- <label>Amount</label> -->
        <input type="number" style=' width: 80%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;' name="amount" required value="<?php echo $row['amount'];?>">
        
    </div>
    <div>
      <!-- <label>Description</label> -->
      <textarea rows="1" cols="20" style=' width: 80%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;' name="description" required><?php echo $row['description'];?></textarea>
    </div>
     <br><br>
    <input type="submit" name="submit" value="Update" class="button-63">
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









