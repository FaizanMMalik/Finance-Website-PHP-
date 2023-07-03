
<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}

$current="partner";
if(isset($_GET['assetid']))
{
  $current="category";
}
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
  <link href="assets/css/tabled.scss" rel="stylesheet">
  <link href="assets/css/btn.css" rel="stylesheet">
  <!-- =======================================================
  * Template Name: UpConstruction - v1.3.0
  * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>input[type=number] {
  border-radius: 10px;
  background-color: rgba(128, 225, 255, 0.2);
  color:white;
  }
 </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include 'partial/header.php';
  include 'database.php';
  
  ;?>
  
  <!-- End Header -->
  <br><br><br><br>
  <section id="hero" class="hero">
      <?php
      if(isset($_GET['assetid']))
{
  $query="select * from assets where id=".$_GET['assetid'];
}
else
{
  $query="select * from partner where id=".$_GET['id'];
}
$result = @mysqli_query($conn, $query);
  if(!$result)
  {
    echo 'There is an issue with the database';
    exit;
}
      if($row = @mysqli_fetch_assoc($result))
 {
  if(isset($_GET['assetid']))
  
{
echo "<center><label style='color:orange; font-size:30px'>Asset: ".$row["name"]."</label></center><br>";
}
else
{
  echo "<center><label style='color:orange; font-size:30px'>".$row["name"]."</label></center><br>";
}
 }
      ?>
  <div style='margin-top:-10px'>
 <center>
  <label style="color:yellow">Year</label>
  <input type="number"   style="width:57px; " id="year1" <?php if(isset($_GET['year1'])){echo "value=".$_GET["year1"];}?>>
  <label style="color:yellow">Month</label>
  <input type="number"  style="width:57px" id="month1" <?php if(isset($_GET['month1'])){echo "value=".$_GET["month1"];}?>>
  <label style="color:yellow">Day</label>
  <input type="number"  style="width:57px"  id="day1" <?php if(isset($_GET['day1'])){echo "value=".$_GET["day1"];}?>>
  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<label style="color:yellow; font-size:26px"  >To</label>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
  <label style="color:yellow"  >Year</label>
  <input type="number"  style="width:57px"  id="year2" <?php if(isset($_GET['year2'])){echo "value=".$_GET["year2"];}?>>
  <label style="color:yellow"  >Month</label>
  <input type="number"  style="width:57px"  id="month2" <?php if(isset($_GET['month2'])){echo "value=".$_GET["month2"];}?>>
  <label style="color:yellow" >Day</label>
  <input type="number"  style="width:57px"  id="day2" <?php if(isset($_GET['day2'])){echo "value=".$_GET["day2"];}?>>
  <input type="button" name="filter" value="Filter" onclick="load()"/>
  
 <br>
 
  
 
 

    </center>
  </div>


  
<div>
<center>
<div id="table">

  </div>
</center>
  </div>
  <br><br><br>
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
  $(document).ready(function() {
  //   var today = new Date();
  // var yyyy = today.getFullYear();
  // document.getElementById("year1").value = "2022";
  load();
});
  function load() {
    var url="partnerDetailInvestmentTable.php?";
    var year1=document.getElementById("year1").value;
    var month1=document.getElementById("month1").value;
    var day1=document.getElementById("day1").value;
    var year2=document.getElementById("year2").value;
    var month2=document.getElementById("month2").value;
    var day2=document.getElementById("day2").value;
    document.getElementById("year1").style.border = "1px solid black";
    document.getElementById("month1").style.border = "1px solid black";
    document.getElementById("day1").style.border = "1px solid black";
    document.getElementById("year2").style.border = "1px solid black";
    document.getElementById("month2").style.border = "1px solid black";
    document.getElementById("day2").style.border = "1px solid black";
    if(year1!="")
    {
      
      url=url+"year1="+year1+"&";
    }
    if(month1!="")
    {
      url=url+"month1="+month1+"&";
      
      if(year1=="")
    {
      document.getElementById("year1").style.border = "3px solid red";
      return;
    }
    }
    if(day1!="")
    {
      
      url=url+"day1="+day1+"&";
      if(month1=="")
    {
      document.getElementById("month1").style.border = "3px solid red";
      return;
    }
    }
    if(year2!=""||month2!=""||day2!="")
    {
      if(day1=="")
    {
      document.getElementById("day1").style.border = "3px solid red";
      return;
    }
    if(year2!="")
    {
      
      url=url+"year2="+year2+"&";
    }
    else
    {
      document.getElementById("year2").style.border = "3px solid red";
      return;
    }
    if(month2!="")
    {
      
      url=url+"month2="+month2+"&";
      
    }
    else
    {
      document.getElementById("month2").style.border = "3px solid red";
      return;
    }
    if(day2!="")
    {
      
      url=url+"day2="+day2+"&";
    }
    else
    {
      document.getElementById("day2").style.border = "3px solid red";
      return;
    }
    }
    console.log("hay");
    url=url+<?php if(isset($_GET['assetid'])){echo "'assetid='+".$_GET["assetid"];}else{echo "'id='+".$_GET["id"];}?>;
    console.log(url);
    
    
    
    <?php //if(isset($_GET['assetid'])){echo "assetid=".$_GET["assetid"];}else{echo "id=".$_GET["id"];}?>;
        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                $("#table").html(data);
            }
        });
      }
</script>










