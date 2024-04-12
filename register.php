<?php include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $username = $_POST["username"];
    $pass = md5($_POST["password"]);
    $cpass = md5($_POST["confirm_password"]);
    $type = $_POST["UserType"];

    if ($pass == $cpass) {

        $query = "INSERT INTO accounts (fullname, address, email, contact_number, username, password, usertype) 
                VALUES ('$name','$address','$email','$number','$username','$pass','$type')";

        $result = mysqli_query($connection, $query);
        // var_dump($query);exit;
        echo " <script> alert('Registration succesfully!'); window.location.href='login.php'</script> ";
    } else {

        echo " <script> alert('password does not match'); </script> ";
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
</head>
<body>
<div class="wrapper">
    <h2>Registration</h2>
    <form action="register.php" method="POST">
      <div class="input-box">
        <input type="text" placeholder="Enter your full name" id="name" name="name" autocomplete="off" required>
      </div>

      <div class="input-box">
        <input type="text" placeholder="Enter your address" id="address" name="address" autocomplete="off" required>
      </div>

      <div class="input-box">
        <input type="text" placeholder="Enter your email" id="email" name="email" autocomplete="off" required>
      </div>

      <div class="input-box">
        <input type="number" placeholder="Enter your contact number" id="number" name="number" autocomplete="off" required>
      </div>

      <div class="input-box">
        <input type="text" placeholder="Enter your username" id="username" name="username" autocomplete="off" required>
      </div>

      <div class="input-box">
        <input type="password" placeholder="Create password" id="password" name="password" autocomplete="off" required>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Confirm password" id="confirm_password" name="confirm_password" autocomplete="off" required>
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
        <input type="Submit" value="Register Now">
      </div>
      <div class="text">
        <h3>Already have an account? <a href="login.php">Login now</a></h3>
      </div>
    </form>
  </div>
</body>
</html>