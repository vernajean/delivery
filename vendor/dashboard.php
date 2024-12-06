<?php
session_start();

$base_url = "http://" . $_SERVER['SERVER_NAME'] . '/delivery/';
$id = $_SESSION['id'];
include ('../conn.php');

$sql = "SELECT * FROM accounts WHERE id = $id";
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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ExpressDelivery</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= $base_url ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= $base_url ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= $base_url ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= $base_url ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= $base_url ?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= $base_url ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $base_url ?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= $base_url ?>assets/plugins/fontawesome-free/css/all.min.css">
  <style>
    .active {
      background-color: #C6EBC5 !important;
      color: black !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini accent-dark grayish" style="background-color: #283130">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand ">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: white;"><i
              class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" href="<?= $base_url ?>logout.php" role="button" style="color: white;">
            <i class="fas fa-power-off"></i>
            Logout
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-pink elevation-4">
      <!-- Brand Logo -->
      <a href="<?= $base_url ?>assets/index3.html" class="brand-link" style="background-color: #283130;">
        <img src="<?= $base_url ?>images/goods.jpeg" alt="Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text fw-bold text-white">Express Delivery</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block"><?= $users['fullname']; ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= $base_url ?>vendor/dashboard.php" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= $base_url ?>vendor/orders.php" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Orders
                </p>
              </a>
            </li>

            <!-- <li class="nav-item">
            <a href="<?= $base_url ?>vendor/dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Logs
              </p>
            </a>
          </li> -->
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
        </div>
      </section>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-4">
              <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-shopping-bag"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">New Orders</span>
                  <span class="info-box-number">
                    <?php
                    $query = "SELECT o.*,p.image,p.description,p.product_name FROM orders as o INNER JOIN product as p ON o.product_id = p.id WHERE o.seller_id = '$id' AND o.order_status=1";
                    $result = $connection->query($query);
                    echo $result->num_rows;
                    ?>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </div>


          </div>
        </div>
      </section>
    </div>

    <?php include ('footer.php'); ?>
  </div>