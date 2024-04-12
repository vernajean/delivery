<?php
session_start();
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["Username"];
    $password = md5($_POST["Password"]);
    $userType = $_POST["UserType"];


    $sql = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password' AND usertype = '$userType'";
    $result = mysqli_query($connection, $sql);
    // var_dump($result);exit;
    if ($result->num_rows >= 1) {
        $row = $result->fetch_assoc();

            // Add user login activity log
            $userId = $row['id'];
            $activity = 'Login into the system.';
            $logSql = "INSERT INTO aclogs (account_id, activity) VALUES ('$userId','$activity')";
            mysqli_query($connection, $logSql);
        

        $_SESSION['id'] = $row['id'];
        $_SESSION["username"] = $username;
        
        // Redirect based on user type
        if ($userType == "Vendor") {
            header("location:vendor/dashboard.php");
        } elseif ($userType == "Customer") {
            header("location:customers/home.php");
        } else if ($userType == "Courier") {
            header("location:couriers/dashboard.php");
        } else if ($userType == "Admin") {
            header("location:admin/dashboard.php");
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
    <link rel="stylesheet" href="css/login.css">
    <title>ExpressDelivery</title>
    <style>
        
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Login</h2>
    <form action="login.php" method="POST" class="login">
        <div class="input-box">
            <input type="text" placeholder="Enter username" name="Username" autocomplete="off" required>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Enter password" name="Password" autocomplete="off" required>
        </div>
        <div class="input-box">
                <select name="UserType" class="dp" required>
                    <option value="" disabled selected>Select User Type</option>
                    <option>Customer</option>
                    <option>Vendor</option>
                    <option>Admin</option>
                    <option>Courier</option>
                </select>
            </div>

        <div class="input-box button">
        <input type="Submit" value="Login">
      </div>
      <div class="text">
        <h3>Already have an account? <a href="register.php">Register</a></h3>
      </div>
    </form>
  </div>

</body>
</html>