<?php

  
    // Create connection
    $conn = mysqli_connect($host, $user, $password, $dbname);

    // Check connection
    if (!$conn) {
        $connection="not created";
        die("Connection failed: " . mysqli_connect_error());
    }
    else
    {
    $connection="created";
    }
?>