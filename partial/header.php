<?php
if(!isset($current))
{
    $current="home";
}
?>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between" style="background-color:black">

      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="../assets/img/logo.png" alt=""> -->
        <h1>KSN BUILDERS<span>.</span></h1>

      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar" >
        <ul>
        <li><a href="index.php" <?php if($current=="home"){echo " class='active'";}?>>Home</a></li>
          <li><a href="partner.php" <?php if($current=="partner"){echo " class='active'";}?>>Partners</a></li>
          <li class="dropdown"><a href="#" <?php if($current=="category"){echo " class='active'";}?>><span>Categories</span> <i
                class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
            <li><a href="sale.php">Sales</a></li>
              <li><a href="purchase.php">Expense</a></li>
              
              
              <li><a href="assets.php">Assets</a></li>
              <li><a href="worker.php">Workers</a></li>
              <li><a href="fourMan.php">ForeMan</a></li>
            </ul>
          </li>
          <li><a href="statistics.php" <?php if($current=="statistics"){echo " class='active'";}?>>Statistics</a></li>
          <li><a href="logout.php">Logout</a></li>
          <!-- <li><a href="projects.html">Projects</a></li>
          
          <li><a href="blog.html">Blog</a></li>
          <li><a href="contact.html">Contact</a></li> -->
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->








