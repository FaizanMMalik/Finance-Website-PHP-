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
  <title>KSN- Update Parnters </title>
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
        $query = "select * from partner where id='$_POST[id]'";
       }
       else if(isset($_GET['id']))
       {
        $query = "select * from partner where id='$_GET[id]'";
       }
       else
       {
        echo "<script>window.location.replace('partner.php');</script>";
         exit;
       }
       $result = @mysqli_query($conn, $query);
       if($row = @mysqli_fetch_assoc($result))
       {

       }
       else
       {
           mysqli_close($conn);
           echo "<script>window.location.replace('partner.php');</script>";
         exit;
       }
      if (isset($_POST['submit'])) {
        $sql = "select * from partner where username like '$_POST[userName]' and id !='$_POST[id]'";
$result = @mysqli_query($conn, $sql);
$i=0;
if($row = @mysqli_fetch_assoc($result))
{
  echo "<script>
  window.alert('UserName Already Exits: ');
  </script>";
  mysqli_close($conn);
}
else
{
        $sql = "UPDATE `partner` SET `name`='$_POST[name]',`userName`='$_POST[userName]',`password`='$_POST[password]',`contactNumber`='$_POST[contactNumber]'";
        if(isset($_FILES['image']))
        {
          if ($_FILES["image"]["error"] == UPLOAD_ERR_OK)
          {
            $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "assets/img/" . $filename;
        move_uploaded_file($tempname, $folder);
        $sql=$sql.",`image`='$filename'";

        }
      }
        $admin=0;
        if(isset($_POST['admin']))
        {
          $admin=1;
        }
        $sql=$sql.",`isadmin`='$admin' where id='$_POST[id]'";
          mysqli_query($conn, $sql);
          mysqli_close($conn);
          echo "<script>window.location.replace('partner.php');</script>";
          exit;
      }
        
    }
    
    ?>
<div>
  <center>
    <br><br>
    <h2 style="color:orange" ><b>Update Partner</b></h2>
  </center>
    <form action="partnerUpdate.php?id=<?php echo $_GET['id'];?>" method="post" enctype="multipart/form-data">
      <center>
    <div hidden>
      <label>id</label>
        <input type="text"  name="id" id="id" value="<?php echo $row['id'];?>">
        
      </div>
    <div>
      
        <input type="text"  placeholder=" Name" name="name" id="name" required value="<?php if(isset($_POST['name'])){echo $_POST['name'];}else{echo $row['name'];}?>">
        
      </div>
      <div>
      
        <input type="text"  placeholder=" Username" name="userName" id="userName" required value="<?php if(isset($_POST['userName'])){echo $_POST['userName'];}else{echo $row['userName'];}?>">
        
      </div>
      <div>
   
        <input type="text"  placeholder=" Password" name="password" id="password" required value="<?php if(isset($_POST['password'])){echo $_POST['password'];}else{echo $row['password'];}?>">
        
      </div>
      <div>
      
        <input type="text"   placeholder=" Contact Number" name="contactNumber" required value="<?php if(isset($_POST['contactNumber'])){echo $_POST['contactNumber'];}else{echo $row['contactNumber'];}?>">
        
      </div>
      
      <input type="file" id="fileInput" accept="image/*" name="image">
      <br>
        <img style='width:20%' id="preview" src="<?php echo "assets/img/$row[image]";?>">
        <br>
        <input type="checkbox" id="admin" name="admin" value="1" <?php if($row['isAdmin']=="1") {echo "checked";}?>>
        
        <label for="admin" style="color:white">Admin?</label><br>
          <br><br>
      <input type="submit" class="button-63" name="submit" value="Save">
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

</body>

</html>












      
  <script type="text/javascript">
  var fileInput = document.getElementById("fileInput");
  var preview = document.getElementById("preview");

  fileInput.addEventListener("change", function() {
    var file = fileInput.files[0];
    var reader = new FileReader();

    reader.addEventListener("load", function() {
      preview.src = reader.result;
    });

    reader.readAsDataURL(file);
  });
  function validateForm() {
//     var userName = document.getElementById('userName').value;
//     var password = document.getElementById('password').value;
//     <?php
//     include 'database.php';
//     $query = "SELECT * FROM partner";
//     $result = @mysqli_query($conn, $query);
// if($row = @mysqli_fetch_assoc($result))
// {
//       echo "console.log(false);";
//     echo "return false;";
// }
//      ?>
return true;
  }
</script>
    