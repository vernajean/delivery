<?php
session_start();


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
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body class="sb-nav-fixed">
    <!--===========================   NAVBAR   =====================================-->
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #f4cbc6">

        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Delivery</a>

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

    <!--===========================   SIDEBARBAR   =====================================-->

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #f4cbc6">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <!-- DASHBOARD -->
                    <a class="nav-link active" href="./adminProduct.php">
                        <div class="sb-nav-link-icon "><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <!-- ACCOUNTS -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCustomers" aria-expanded="false" aria-controls="collapseCustomers">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Customer Information
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseCustomers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="./customer/allCustomer.php">Customers Information</a>
                            <a class="nav-link" href="./customer/addCustomer.php">Add New Customers</a>
                        </nav>
                    </div>

                    <!-- STAFF INFORMATION -->    
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStaff" aria-expanded="false" aria-controls="collapseStaff">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Staff information
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseStaff" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="./staff/allStaff.php">Staff's Data</a>
                            <a class="nav-link" href="./staff/addStaff.php">Add New Staff</a>
                        </nav>
                    </div>

                    <!-- Product INFORMATION -->    

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseProduct">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Product Information
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseProduct" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="./product/allProduct.php">Products Data</a>
                            <a class="nav-link" href="./product/addProduct.php">Add New Product</a>
                        </nav>
                    </div>

                    <!-- LOGS INFORMATION -->
                    <a class="nav-link " href="../productUserLogs.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Customer Logs
                    </a>

                    <a class="nav-link " href="../productAdminLogs.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        My Logs
                    </a>

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <h3><?php echo $users['fullname']; ?></h3>
            </div>
        </nav>
    </div>

    <!--===========================   MAIN   =====================================-->

    <div id="layoutSidenav_content">
    <main>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-4 col-md-6 mt-4">
                <div class="card text-black mb-4" style="background-color: #f9dce8">
                    <div class="card-body text-center">
                        <h3>Total Number of Customers </h3>
                        <?php
                        include('../conn.php');

                        $query = "SELECT * FROM users WHERE user_type = 'user (Product)' ";
                        $run_query = mysqli_query($connection, $query);

                        $row = mysqli_num_rows($run_query);

                        echo '<h1>' . $row . '</h1>'
                        ?>

                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #f4cbc6">
                        <a class="small text-white stretched-link" href="./customer/allCustomer.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mt-4">
                <div class="card text-black mb-4" style="background-color: #f9dce8">
                    <div class="card-body text-center">
                        <h3>Total Number of Products </h3>
                        <?php
                        include('../conn.php');
                        $query = "SELECT * FROM product WHERE product_type = 'Product' ";
                        $run_query = mysqli_query($connection, $query);

                        $row = mysqli_num_rows($run_query);

                        echo '<h1>' . $row . '</h1>'
                        ?>


                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #f4cbc6">
                        <a class="small text-white stretched-link" href="./product/allProduct.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mt-4">
                <div class="card text-black mb-4" style="background-color: #f9dce8">
                    <div class="card-body text-center">
                        <h3>Total Number of Staffs </h3>
                        <?php
                        include('../conn.php');
                        $query = "SELECT * FROM users WHERE user_type = 'staff (Product)' ";
                        $run_query = mysqli_query($connection, $query);

                        $row = mysqli_num_rows($run_query);

                        echo '<h1>' . $row . '</h1>'
                        ?>


                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #f4cbc6">
                        <a class="small text-white stretched-link" href="./staff/allStaff.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>

    <!--===========================   FOOTER   =====================================-->

<?php include('../includes/footer.php'); ?>

    <!--===========================   SCRIPT   =====================================-->

<script>
    window.addEventListener('DOMContentLoaded', event => {

// Toggle the side navigation
const sidebarToggle = document.body.querySelector('#sidebarToggle');
if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener('click', event => {
        event.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled');
        localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
    });
}

});
</script>

<?php include('../includes/script.php'); ?>