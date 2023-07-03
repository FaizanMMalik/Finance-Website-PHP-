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
  <title>KSN- Expenses</title>
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
  <style>
  .button-63 {
  align-items: center;
  background-image: linear-gradient(144deg,#130120, #5B42F3 50%,#0b383b);
  border: 0;
  border-radius: 8px;
  box-shadow: rgba(151, 65, 252, 0.2) 0 15px 30px -5px;
  box-sizing: border-box;
  color: #FFFFFF;
  display: flex;
  font-family: Phantomsans, sans-serif;
  font-size: 20px;
  justify-content: center;
  line-height: 1em;
  max-width: 100%;
  min-width: 140px;
  padding: 19px 24px;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  white-space: nowrap;
  cursor: pointer;
}
input[type=number] {
  border-radius: 10px;
  background-color: rgba(128, 225, 255, 0.2);
  color:white;
  }
 


</style>
  <link href="assets/css/tabled.scss" rel="stylesheet">

  <!-- =======================================================
  * Template Name: UpConstruction - v1.3.0
  * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body >

  <!-- ======= Header ======= -->
  <?php include 'partial/header.php';?>
  
  <!-- End Header -->

 
  <section id="hero" class="hero">

  <br><br><br><br><center>

 <h2 style="color:orange">Expenses</h2>
<br>
 <label style="color:yellow">Search</label>
  <input type="text" id="search">

 <br>
 <label style="color:yellow" >Year</label>
  <input  type="number" style="width:57px " id="year1">
  <label style="color:yellow" >Month</label>
  <input type="number" style="width:57px" id="month1">
  <label style="color:yellow" >Day</label>
  <input type="number" style="width:57px" id="day1">
  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<label style="color:yellow; font-size:26px"  >To</label>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
  <label style="color:yellow" >Year</label>
  <input type="number" style="width:57px" id="year2">
  <label style="color:yellow" >Month</label>
  <input type="number" style="width:57px" id="month2">
  <label style="color:yellow">Day</label>
  <input type="number" style="width:57px" id="day2">
  <br>
  <input type="button" name="filter" value="filter" onclick="load()"/>

 <div id="table">

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
  <script src="assets/js/jquery-3.6.0.min.js"></script>
</body>

</html>
<script>
  $(document).ready(function() {
    
  load();
});
  function load() {
    var url="purchaseTable.php?";
    var search=document.getElementById("search").value;
    var year1=document.getElementById("year1").value;
    var month1=document.getElementById("month1").value;
    var day1=document.getElementById("day1").value;
    var year2=document.getElementById("year2").value;
    var month2=document.getElementById("month2").value;
    var day2=document.getElementById("day2").value;
    if(search!="")
    {
      document.getElementById("search").style.border = "1px solid black";
      url=url+"search="+search+"&";
    }
    if(year1!="")
    {
      document.getElementById("year1").style.border = "1px solid black";
      url=url+"year1="+year1+"&";
    }
    if(month1!="")
    {
      url=url+"month1="+month1+"&";
      document.getElementById("month1").style.border = "1px solid black";
      if(year1=="")
    {
      document.getElementById("year1").style.border = "3px solid red";
      return;
    }
    }
    if(day1!="")
    {
      document.getElementById("day1").style.border = "1px solid black";
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
      document.getElementById("year2").style.border = "1px solid black";
      url=url+"year2="+year2+"&";
    }
    else
    {
      document.getElementById("year2").style.border = "3px solid red";
      return;
    }
    if(month2!="")
    {
      document.getElementById("month2").style.border = "1px solid black";
      url=url+"month2="+month2+"&";
      
    }
    else
    {
      document.getElementById("month2").style.border = "3px solid red";
      return;
    }
    if(day2!="")
    {
      document.getElementById("day2").style.border = "1px solid black";
      url=url+"day2="+day2+"&";
    }
    else
    {
      document.getElementById("day2").style.border = "3px solid red";
      return;
    }
    }
    
    
    
    
    
    
    
    var preurl = url.substring(0, url.length - 1);
        $.ajax({
            type: "GET",
            url: preurl,
            success: function(data) {
                $("#table").html(data);
            }
        });
      }
      function deletePurchase(id) {
        if (confirm("Are you sure you want to delete this item?")) {
          var url="purchaseDelete.php?id="+id;
  $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                
            }
        });
load();
}
      }
</script>










