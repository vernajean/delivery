<?php
session_start();
include ("conn.php");
$base_url = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"] . '?') . '/';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["Username"];
    $password = $_POST["Password"];
    $userType = $_POST["UserType"];


    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND user_type = '$userType'";
    $result = mysqli_query($connection, $sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Add user login activity log
        $userId = $row['id'];
        $userNAme = $row['fullname'];
        $activityType = 'Login';
        $logSql = "INSERT INTO logs (user_id, name, subType, activity_type) VALUES ('$userId', '$userNAme', '$userType', '$activityType')";
        mysqli_query($connection, $logSql);


        $_SESSION['id'] = $row['id'];
        $_SESSION["username"] = $username;

        // Redirect based on user type
        if ($userType == "user (E-toy)") {
            header("location:subE-toy/userE-toy.php");
        } elseif ($userType == "admin (E-toy)") {
            header("location:subE-toy/adminE-toy.php");
        } elseif ($userType == "user (Furniture)") {
            header("location:subFurniture/userFurniture.php");
        } elseif ($userType == "admin (Furniture)") {
            header("location:subFurniture/adminFurniture.php");
        } elseif ($userType == "user (Goods)") {
            header("location:subGoods/userGoods.php");
        } elseif ($userType == "admin (Goods)") {
            header("location:subGoods/adminGoods.php");
        } elseif ($userType == "user (Product)") {
            header("location:subProduct/userProduct.php");
        } elseif ($userType == "admin (Product)") {
            header("location:subProduct/adminProduct.php");
        }
    } else {
        echo "<script type='text/javascript'>
            alert('Invalid username or password');
            window.location = 'index.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $base_url ?>/css/w3-school.css">
    <title>ExpressDelivery</title>
    <style>
        .w3-section,
        .w3-code {
            margin-top: 16px !important;
            margin-bottom: 16px !important
        }

        .mySlides {
            display: none;
            width: 100%;
            height: 430px;
        }

        .wrapper {
            max-width: none !important;
            height: 500px;
            margin: 50px 100px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f8f0e0;
        }

        .header {
            overflow: hidden;
            background-color: #283130;
            padding: 20px 10px;
        }

        .header a {
            float: left;
            color: whitesmoke;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            line-height: 25px;
            border-radius: 4px;
        }

        .header a.logo {
            font-size: 25px;
            font-weight: bold;
        }

        .header a:hover {
            background-color: #ddd;
            color: black;
        }

        .header a.active {
            background-color: #ff6b2c;
            color: white;
        }

        .header-right {
            float: right;
            margin-right: 80px;
        }
    </style>
</head>

<body>
    <div class="header">
        <a href="#default" class="logo">
            <img src="<?= $base_url ?>images/boo.jpg" width="50px" style="margin-left: 50px">
        </a>
        <div class="header-right">
            <a href="<?= $base_url ?>">Home</a>
            <a class="active" href="<?= $base_url ?>contact.php">About Us</a>
            <a href="<?= $base_url ?>login.php">Login</a>
        </div>
    </div>
    <div class="wrapper">   
            <h1>About the Developer:</h1>
           <div class="about-author">
    <div class="author-bio">
        <img src="<?= $base_url ?>images/arls.jpg" width="200px" height="200px" style="border-radius: 50%; margin: 20px;">
        <h2>Full Name:</h2>
        <p>Verna Jean Abarzosa</p>
        <h2>Contact:</h2>
        <p>
            <a href="mailto:verna@gmail.com">verna@gmail.com</a>
            <br>
        
        </p>
        <h2>Address:</h2>
        <p>Malitbog Southern Leyte</p>
        <h2>Programming Languages:</h2>
        <p>
            <ul>
                <li>PHP</li>
                <li>JavaScript</li>
                <li>HTML/CSS</li>
                <li>MySQL</li>
            </ul>
        </p>
        <h2>System/Project Developed and Accomplished:</h2>
        <p>
            <ul>
                <li>ExpressDelivery System</li>
                <li>Barangay System</li>
                <li>Student Management System</li>
            </ul>
        </p>
        <h2>OTHER INFORMATION:</h2>
        <p>To ensure that our system is work smoothly and passionate about open-source technologies, software development also customer satisfaction</p>
    </div>
</div> 
     </div>
    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) { myIndex = 1 }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 2000); // Change image every 2 seconds
        }
    </script>
</body>

</html>