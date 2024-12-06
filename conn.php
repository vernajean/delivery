<?php
    
   // $conn = mysqli_connect("sql6.freesqldatabase.com", "sql6691333", "JcDgZUMWNU", "sql6691333");
    //$connection = mysqli_connect("sql.freedb.tech", "freedb_verna", "Q#M#snMx3?un9nA", "freedb_delivery");


   $connection = mysqli_connect("localhost", "root", "", "delivery_db");

    if ($connection === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // return $connection;

// $conn = connectToDatabase();
?>
