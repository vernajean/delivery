<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body class="sb-nav-fixed">
    <!--===========================   NAVBAR   =====================================-->
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #704e2e">

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
                            <a class="dropdown-item text-dark" href="../../logout.php">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </form>
    </nav>

    <!--===========================   SIDEBARBAR   =====================================-->

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #704e2e">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <!-- DASHBOARD -->
                    <a class="nav-link " href="../adminFurniture.php">
                        <div class="sb-nav-link-icon "><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <!-- ACCOUNTS -->
                    <a class="nav-link collapsed active" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCustomers" aria-expanded="false" aria-controls="collapseCustomers">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Customer Information
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseCustomers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="./allCustomer.php">Customers Information</a>
                            <a class="nav-link active" href="./addCustomer.php">Add New Customers</a>
                        </nav>
                    </div>

                    <!-- STAFF INFORMATION -->    
                    <a class="nav-link collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#collapseStaff" aria-expanded="false" aria-controls="collapseStaff">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Staff information
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseStaff" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="../staff/allStaff.php">Staff's Data</a>
                        <a class="nav-link" href="../staff/addStaff.php">Add New Staff</a>
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
                            <a class="nav-link" href="../product/allProduct.php">Products Data</a>
                            <a class="nav-link" href="../product/addProduct.php">Add New Product</a>
                        </nav>
                    </div>

                    <!-- LOGS INFORMATION -->
                    <a class="nav-link " href="../../furnitureUserLogs.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Customer Logs
                    </a>

                    <a class="nav-link " href="../../furnitureAdminLogs.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        My Logs
                    </a>

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <h3>hello</h3>
            </div>
        </nav>
    </div>

    <!--===========================   MAIN   =====================================-->

    <div id="layoutSidenav_content">
    <main>

        <?php
        include('../../conn.php');

        if (isset($_POST['submit'])) {

            $name = $_POST['name'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $type = $_POST['userType'];

            $sql = "INSERT INTO users (fullname, address, email, number, username, password, user_type) VALUES ('$name', '$address', '$email', '$number', '$username', '$password', '$type')";

            $result = $connection->query($sql);

            if ($result) {
                echo "<script>
                alert('Customer added successfully');
                window.location.href = './allCustomer.php';
                </script>";
            } else {
                echo "<script>
                alert('Adding Customer unsuccessful');
                window.location.href = './addCustomer.php';
                </script>";
            }
        }

        ?>

        <div class="col-xl-4 mt-2 mx-auto" style="width: 600px">
            <div class="card text-white mb-4 " style="background-color: #704e2e">
                <div class="card-header text-center">
                    <h1>ADD CUSTOMER</h1>
                </div>
                <div class="card-body text-center" style="background-color: #849483">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="addCustomer.php" method="POST">

                                <div class="form-group mt-3">
                                    <label>Full name</label>
                                    <div>
                                        <input type="text" class="form-control border border-info" id="name" name="name" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label>Address</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control border border-info" id="address" name="address" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label>Email</label>
                                    <div class="cal-icon">
                                        <input type="email" class="form-control border border-info" id="email" name="email" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label>Contact number</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control border border-info" id="number" name="number" autocomplete="off" required>
                                    </div>
                                </div>


                                <div class="form-group mt-3">
                                    <label>Username</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control border border-info" id="username" name="username" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label>Password</label>
                                    <div class="cal-icon">
                                        <input type="password" class="form-control border border-info" id="password" name="password" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" id="userType" name="userType" value="user (Furniture)">
                                </div>

                                <div class="text-center">
                                    <button type="submit" name="submit" id="submit" class="btn btn-success btn-lg mt-4">Add Customer </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>

    <!--===========================   FOOTER   =====================================-->

    <?php include('../../includes/footer.php'); ?>

    <!--===========================   SCRIPT FOR TOGGLE SIDEBAR   =====================================-->

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

    <!--===========================   SCRIPTS FOR TABLE   =====================================-->

<script>
    window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});

</script>

<?php include('../../includes/script.php'); ?>