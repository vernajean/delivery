<?php
session_start();

$base_url="http://".$_SERVER['SERVER_NAME'].'/delivery/';
$id = $_SESSION['id'];
include('../conn.php');

$sql = "SELECT * FROM users WHERE id = $id";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
	$users = $result->fetch_assoc();
} else {
	die('User not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= $base_url?>css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body class="sb-nav-fixed">
    <!--===========================   NAVBAR   =====================================-->
    <nav class="sb-topnav navbar navbar-expand" style="background-color: #f4cbc6;color:black">

        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#">Delivery</a>

        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <!-- Navbar-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item text-dark" href="../logout.php">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </form>

    </nav>
    <!--####################################################################################################################################################-->

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #f4cbc6;color:black">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <!-- DASHBOARD -->
                    <a class="nav-link active" style="color: black" href="userProduct.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: black"></i></div>
                        Dashboard
                    </a>

                    <a class="nav-link " href="update.php" style="color: black">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: black"></i></div>
                        My Accoount Info
                    </a>

                    <a class="nav-link " href="#" style="color: black">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: black"></i></div>
                        My Orders Info
                    </a>

                    <a class="nav-link " href="userLogs.php" style="color: black">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: black"></i></div>
                        My Logs
                    </a>

                    <a class="nav-link " href="#" style="color: black">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: black"></i></div>
                        Payment Page
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <h3><?php echo $users['fullname']; ?></h3>
            </div>
        </nav>
    </div>