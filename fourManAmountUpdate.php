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
        $query = "select fa.id,fa.amountRecieve as recieve,fa.amountSend as send,fa.date,fa.detail,f.id as faid,f.name,p.id as pid,p.name as pname from fourmanamount fa inner join fourman f on f.id=fa.fourManId inner join partner p on p.id=fa.partnerId where fa.id='$_GET[id]'";
       $result = @mysqli_query($conn, $query);
       if($row = @mysqli_fetch_assoc($result))
       {
        
       }
       else
       {
           mysqli_close($conn);
           echo "<script>history.go(-2);</script>";
         exit;
       }
      if (isset($_POST['submit'])) {
          $send=0;
       $recieve=0;
        if($_GET["send"]==1)
        {
          $send=$_POST["amount"];
        }
        else
        {
          $recieve=$_POST["amount"];
        }
        $sql = "UPDATE `fourmanamount` SET `amountRecieve`='$recieve',`amountSend`='$send',`date`='$_POST[date]',`detail`='$_POST[detail]',`partnerId`='$_POST[partner]' WHERE id='$_POST[id]'";
        
          mysqli_query($conn, $sql);
          mysqli_close($conn);
          echo "<script>history.go(-2);</script>";
          exit;
        
    }
    mysqli_close($conn);
    ?>
<div><br><br><br><br>
    <div>
        <?php
  
            echo "<h2 style='color:yellow'>$row[name]</h2>";
        ?>
    
        <form action="fourManAmountUpdate.php?id=<?php echo $_GET['id'];?>&send=<?php echo $_GET['send'];?>" method="post">
              <div>
            <!--<label style='color:yellow'>Date</label>-->
            <input type="date" name="date" id="date" style=" width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;"value="<?php if(isset($_POST['date'])){echo $_POST['date'];}else{echo $row["date"];}?>"/>
        
        </div>
        <?php
            include 'database.php';
            // echo "<br><label style='color:yellow'>Partner</label>";
            $sql = "SELECT id,name FROM partner where isActive='1'";
    
            // Execute the SQL query
            $result = mysqli_query($conn, $sql);
    
            // Check the result
            if (mysqli_num_rows($result) > 0) {
                echo "<select style=' width: 80%;
                    padding: 12px 20px;
                    margin: 8px 0;
                    box-sizing: border-box;' name='partner'>";
                    // Loop through the result
                        while ($rows = mysqli_fetch_assoc($result)) {
                            echo "<option value='$rows[id]'";
                            if(isset($_GET["id"])&&$rows["id"]==$row["pid"])
                            {
                                echo " selected";
                            }
                            echo ">" . $rows["name"] . "</option>";
                        }
                echo "</select>";
            }
            else
            {
                echo mysqli_num_rows($result);
            }
        ?>
            <input type="number" name="id" hidden value="<?php if(isset($_GET['id'])){echo $_GET['id'];}?>">
        <div>
            <!--<label style='color:yellow'>Amount</label>-->
            <input type="number" name="amount" style=" width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;" required value="<?php if(isset($_POST['amount'])){echo $_POST['amount'];} else if($row["send"]=="0"){echo $row["recieve"];} else{echo $row["send"];}?>">
        
        </div>
        <div>
            <!--<label style='color:yellow'>Detail</label>-->
            <input type="text" name="detail" required value="<?php if(isset($_POST['detail'])){echo $_POST['detail'];}else{echo $row["detail"];}?>">
        
        </div>
      
      
      
        <br><br>
        <input type="submit" class="button-63"name="submit" value="Update">
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </form>
  </div>
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









