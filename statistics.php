<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']=="")
{
  echo "<script>window.location.replace('login.php');</script>";
  exit;
}
$current="statistics";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="assets/img/ksnlogo.jpg" rel="icon">
  <title>KSN- Statistics</title>
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
  input[type=text] {
  border-radius: 10px;
  background-color: rgba(128, 225, 255, 0.2);
  color:white;
  padding: 20px;
 width:250px
  }
 </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include 'partial/header.php';?>
  
  <!-- End Header -->

  <section id="hero" class="hero">
  
<br><br><br><br><center>

<h2 style="color:orange"><b>STATISTICS</b></h2>
<label style="color:yellow">Year</label>
  <input type="number" style="width:57px" id="year1">
  <label style="color:yellow">Month</label>
  <input type="number" style="width:57px"  id="month1">
  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<label style="color:yellow; font-size:26px"  >To</label>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
 
  <label style="color:yellow">Year</label>
  <input type="number" style="width:57px"  id="year2">
  <label style="color:yellow" >Month</label>
  <input type="number" style="width:57px" id="month2">
  <input type="button" name="filter" value="filter" onclick="load()"/>
  <br>
  <div id="data">

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
  $(document).ready(function() {
  //   var today = new Date();
  // var yyyy = today.getFullYear();
  // document.getElementById("year1").value = yyyy;
  load();
});
function checkdate()
{
  
}
  function load() {
    var url="partnerInvestmentData.php?";
    var year1=document.getElementById("year1").value;
    var month1=document.getElementById("month1").value;
    var year2=document.getElementById("year2").value;
    var month2=document.getElementById("month2").value;
    document.getElementById("year1").style.border = "1px solid black";
    document.getElementById("month1").style.border = "1px solid black";
    document.getElementById("year2").style.border = "1px solid black";
    document.getElementById("month2").style.border = "1px solid black";
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
    if(year2!=""||month2!="")
    {
      if(month1=="")
    {
      document.getElementById("month1").style.border = "3px solid red";
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
    }
    
    
    
    
    
    
    
    var preurl = url.substring(0, url.length - 1);
    console.log(preurl);
        $.ajax({
            type: "GET",
            url: preurl,
            success: function(data) {
                $("#data").html(data);
            }
        });
      }
      function viewPartner(id)
      {
        window.location.href = "";
      }
</script>


