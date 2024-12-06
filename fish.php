<?php 
    include('conn2.php');

    $qryu = "SELECT * FROM fish";
    $sql = $conn2->query($qryu);
    $eav = 0;
    if($sql)
    {
        $eav = 1;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><?php echo $eav;?></p>
</body>
</html>