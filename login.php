<?php
session_start();
if (isset($_POST['submit'])) {
    include 'database.php';
  $username = $_POST['username'];
  $password = $_POST['password'];

      $query = "SELECT * FROM partner where username like '".$_POST['username']."' and password like '".$_POST['password']."'";
      //echo $query;
      $result = @mysqli_query($conn, $query);
if(!$result){
    echo 'There is an issue with the database';
    mysqli_close($conn);
    exit;
}
if($row = @mysqli_fetch_assoc($result))
{
 
    $_SESSION['logged_in'] = true;
     $_SESSION['username'] = $username;
     if($row['isAdmin']==1)
     {
        $_SESSION['admin'] = 1;
     }
     else
     {
        $_SESSION['admin'] = 0;
     }
     echo "<script>window.location.replace('index.php');</script>";
     mysqli_close($conn);
     exit;
}
else
{
  mysqli_close($conn);
        $_SESSION['error'] = 'Incorrect username or password';
        echo "faild";
        echo "<script>window.location.replace('login.php');</script>";
        exit;
      }
 }

?>
<html> <link rel="stylesheet"
href="assets/css/style.css">
<head> <link href="assets/img/ksnlogo.jpg" rel="icon"></head>
<title>KSN- Login</title>
<div class="login-box">
 
    <h2>Login</h2>
    <form action="login.php" method="post">
      
      <div class="user-box">
        <input type="text" name="username" required="">
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="password" required="">
        <label>Password</label>
      </div>
      <?php if (isset($_SESSION['error'])) : ?>
      <div style="color: red;">
        <?php echo $_SESSION['error']; ?>
      </div>
    <?php endif; ?>
      <a href="#">
        
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <input style="height:30px;width:80px;background-color: #03e9f4;border: none;outline: none;"type="submit" name="submit" value="Login">
      </a>
     
    </form>
  </div>
  </html>
  <?php $_SESSION['error'] = '';?>