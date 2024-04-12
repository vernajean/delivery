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
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #704e2e">

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
        <nav class="sb-sidenav accordion sb-sidenav-dark " id="sidenavAccordion" style="background-color: #704e2e">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <!-- DASHBOARD -->
                    <a class="nav-link " href="userFurniture.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <a class="nav-link active" href="update.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        My Accoount Info
                    </a>

                    <a class="nav-link " href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        My Orders Info
                    </a>

                    <a class="nav-link " href="userLogs.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        My Logs
                    </a>

                    <a class="nav-link " href="../payment.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Payment Page
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer" style="background-color: #240c0b">
                <div class="small">Logged in as:</div>
                <h3><?php echo $users['fullname']; ?></h3>
            </div>
        </nav>
    </div>


    <div id="layoutSidenav_content">

<main>

    <?php
    session_start();

    $id = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE user_type = 'user (Furniture)'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $users = $result->fetch_assoc();
    } else {
        die('User not found.');
    }

    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $username = $_POST['username'];
        $password = $_POST['password'];


        // Update the user's data
        $sql = "UPDATE users SET fullname='$name', address='$address', email='$email', number='$number', username='$username', password ='$password' WHERE id= '$id'";

        if ($connection->query($sql) === TRUE) {
            echo "<script type='text/javascript'>
            alert('Updated Successful!');
            window.location = 'update.php';
        </script>";
        } else {
            echo "Error updating record: " . $connection->error;
        }
    }

    $connection->close();
    ?>


    <div class="col-xl-4 mt-5 mx-auto" style="width: 600px">
        <div class="card text-white mb-4">
            <div class="card-header text-center" style="background-color: #704e2e">
                <h2>My Account Info</h2>
            </div>
            <div class="card-body text-center" style="background-color: #849483">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="update.php" method="POST">

                            <div class="form-group mt-3">
                                <label>Full name</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control border border-info" id="name" name="name" value="<?php echo $users['fullname']; ?>" >
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label>Address</label>
                                <div>
                                    <input type="text" class="form-control border border-info" id="address" name="address" value="<?php echo $users['address']; ?>" >
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label>Email</label>
                                <div class="cal-icon">
                                    <input type="email" class="form-control border border-info" id="email" name="email" value="<?php echo $users['email']; ?>">
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label>Contact Number</label>
                                <div class="cal-icon">
                                    <input type="number" class="form-control border border-info" id="number" name="number" value="<?php echo $users['number']; ?>">
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label>Username</label>
                                <div>
                                    <input type="text" class="form-control border border-info" id="username" name="username" value="<?php echo $users['username']; ?>" >
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label>Password</label>
                                <div>
                                    <input type="text" class="form-control border border-info" id="password" name="password" value="<?php echo $users['password']; ?>" >
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" name="submit" id="submit" class="btn btn-success btn-lg mt-4">Update My Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<?php include('../includes/footer.php'); ?>

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