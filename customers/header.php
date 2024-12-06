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
  <link rel="stylesheet" href="<?= $base_url ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-dark grayish navbar-dark grayish">
      <div class="container">
        <a href="#" class="navbar-brand">
          <img src="<?= $base_url ?>images/goods.jpeg" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
          <span class="brand-text font-weight-light">Express Delivery</span>
        </a>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="<?= $base_url . 'customers/home.php' ?>" class="nav-link active">Products</a>
            </li>
            <li class="nav-item">
              <a href="<?= $base_url . 'customers/my_orders.php' ?>" class="nav-link">My Orders</a>
            </li>
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="nav-link dropdown-toggle">Product Type</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="<?= $base_url . 'customers/home.php' ?>?pt=E-toy" class="dropdown-item">E-Toys</a></li>
                <li><a href="<?= $base_url . 'customers/home.php' ?>?pt=Product" class="dropdown-item">Products</a></li>
                <li><a href="<?= $base_url . 'customers/home.php' ?>?pt=Furniture" class="dropdown-item">Cosmetic</a>
                </li>
                <li><a href="<?= $base_url . 'customers/home.php' ?>?pt=Goods" class="dropdown-item">Goods</a></li>
              </ul>
            </li>
          </ul>

          <!-- SEARCH FORM -->
          <form class="form-inline ml-0 ml-md-3">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-shopping-cart"></i>
              <?php
              $query = "SELECT o.*,p.image,p.description,p.product_name FROM orders as o INNER JOIN product as p ON o.product_id = p.id WHERE o.buyer_id = '$id' AND o.order_status=0";
              $result = $connection->query($query);
              ?>
              <span class="badge badge-danger navbar-badge"><?= $result->num_rows; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <?php
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  ?>
                  <a href="#" class="dropdown-item">
                    <div class="media">
                      <img src="<?= $base_url . 'images/uploads/' . $row['image'] ?>" alt="User Avatar" class="img-size-50 mr-3">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          <?= $row['product_name'] ?>
                        </h3>
                        <p class="text-sm">Quantity: <?= $row['quantity'] ?></p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?= $row['date_created'] ?></p>
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                <?php
                }
              } else {
                echo '<center class="btn-info"><p class="text-sm">No product in your cart!</p></center>';
              }
              ?>
              <a href="<?= $base_url . 'customers/my_orders.php' ?>?st=cart" class="dropdown-item dropdown-footer">See My
                Cart</a>
            </div>
          </li>
          <!-- Notifications Dropdown Menu -->
          <!-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li> -->
          <li class="nav-item">
            <a class="nav-link" href="<?= $base_url . 'logout.php' ?>" role="button">
              <i class="fas fa-power-off"></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->