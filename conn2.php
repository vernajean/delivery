<?php
    
  
   $conn2 = mysqli_connect("192.168.0.138", "root", "", "fishop");

    if ($conn2 === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

?>
