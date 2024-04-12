<?php
session_start();
include("../conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["Username"];
    $password = md5($_POST["Password"]);
    $userType = "Cashier";


    $sql = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password' AND usertype = '$userType'";
    $result = mysqli_query($connection, $sql);
    // var_dump($result);exit;
    if ($result->num_rows >= 1) {
        $row = $result->fetch_assoc();

            // Add user login activity log
            $userId = $row['id'];
            $activity = 'Login into the system.';
            $logSql = "INSERT INTO logs (account_id, activity) VALUES ('$userId','$activity')";
            mysqli_query($connection, $logSql);
        

        $_SESSION['id'] = $row['id'];
        $_SESSION["username"] = $username;
        
        // Redirect based on user type
        if ($userType == "Cashier") {
            header("location:dashboard.php");
        }
    } else {
        echo "<script type='text/javascript'>
            alert('Invalid username or password');
            window.location = 'login.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>ExpressDelivery</title>
    <style>
        
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Cashier Login Form</h2>
    <form action="login.php" method="POST" class="login">
        <div class="input-box">
            <input type="text" placeholder="Enter username" name="Username" autocomplete="off" required>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Enter password" name="Password" autocomplete="off" required>
        </div>

        <div class="input-box button">
        <input type="Submit" value="Login">
      </div>
    </form>
  </div>

</body>
</html>