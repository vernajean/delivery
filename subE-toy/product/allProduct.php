<?php
session_start();


$id = $_SESSION['id'];
include('../../conn.php');

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
    <link href="../../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body class="sb-nav-fixed">
    <!--===========================   NAVBAR   =====================================-->
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #f22b1e">

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
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #f22b1e">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <!-- DASHBOARD -->
                    <a class="nav-link " href="../adminE-toy.php">
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
                            <a class="nav-link" href="../customer/allCustomer.php">Customers Information</a>
                            <a class="nav-link" href="../customer/addCustomer.php">Add New Customers</a>
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

                    <a class="nav-link collapsed active" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseProduct">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Product Information
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseProduct" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link active" href="./allProduct.php">Products Data</a>
                            <a class="nav-link" href="./addProduct.php">Add New Product</a>
                        </nav>
                    </div>

                    <!-- LOGS INFORMATION -->
                    <a class="nav-link " href="../../E_toyUserLogs.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Customer Logs
                    </a>

                    <a class="nav-link " href="../../E_toyAdminLogs.php">
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
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center ">
                        <div class="col ">
                            <div class="mt-4">
                                <h1 class="card-title float-left mt-2 text-center">PRODUCT LIST</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 mt-3">
                    <!--<div class="card-header">
                        <i class="fas fa-table me-1"></i>
                            DataTable Example
                    </div>-->
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product ID</th>
                                <th>Image</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Product ID</th>
                                <th>Image</th>
                                <th>actions</th>
                            </tr>
                        </tfoot>
                    <tbody>
                            <?php
                            include('../../conn.php');

                            if (isset($_GET['delete_id'])) {
                                $delete_id = $_GET['delete_id'];
                                // Prepare statement to avoid SQL injection
                                $stmt = $connection->prepare("DELETE FROM product WHERE id = ?");
                                $stmt->bind_param("i", $delete_id); // "i" for integer type
                                $result = $stmt->execute();

                                if ($result) {
                                    echo "<script type='text/javascript'>
                                            alert('Delete Successful!');
                                            window.location = 'all-product.php';
                                        </script>";
                                } else {
                                    echo "<script type='text/javascript'>
                                            alert('Delete Unsuccessful');
                                            window.location = 'all-product.php';
                                        </script>";
                                }

                                $stmt->close();
                            }

                            $sql = "SELECT * FROM product WHERE product_type = 'E-toy'"; // Assuming you have an 'id' field for each user
                            $result = $connection->query($sql);
                            $connection->query("SET @num := 0");
                            $connection->query("UPDATE product SET id = @num := @num + 1");

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['product_name'] . "</td>";
                                    echo "<td><img src='./image" . $row['image'] . "' alt='user Image' class='user-image' style='width: 70px;'></td>";								
                                    echo "<td>";
                                    echo "<a href='./updateProduct.php?id=" . $row['id'] . "' class='btn btn-update btn-primary'>Update</a> ";
                                    echo "<a href='?delete_id=" . $row['id'] . "' class='btn btn-delete btn-danger' onclick='return confirm(\"Are you sure you want to delete this Product?\")'>Delete</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center text-danger'>No results found</td></tr>"; // Updated colspan to match the number of <th> elements
                            }
                            $connection->close();
                            ?>
                    </tbody>
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