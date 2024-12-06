<?php 
    include('header.php');
    $pid = $_GET['pid'];
    $sql = "SELECT * FROM product as p INNER JOIN accounts as a ON a.id = p.account_id WHERE p.id = '$pid'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = $_POST;
        // var_dump($data);exit;
        $query = "INSERT INTO orders ( " . implode(', ', array_keys($data)) . ") VALUES ('". implode("', '", array_values($data))."')";
        $result = $connection->query($query);
        if ($result) {
          // Add user login activity log
          $activity = 'Item added to his/her cart.';
          $logSql = "INSERT INTO logs (account_id, activity) VALUES ('$id','$activity')";
          mysqli_query($connection, $logSql);
            echo "<script>
            alert('Product added to cart!');
            window.location = 'my_orders.php';
            </script>";
        } else {
            echo "<script>
            alert('Adding product unsuccessful');
            window.location = 'my_orders.php';
            </script>";
        }
    }
?>
    <!--===========================   MAIN   =====================================-->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-light yellow">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content" style="margin: 0px 15%;color:black">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="post">
                  <div class="row">
                    <div class="col-sm-6" style="border-right: 2px solid">
                      <h5>Seller: <?= $row['username']?></h5>
                      <img src="<?= $base_url.'images/uploads/'.$row['image']?>" alt="<?= $row['image']?>" style="width: 100%;height:260px">
                    </div>
                    <div class="col-sm-6">
                      <h1><?= $row['product_name']?></h1>
                      <h5>Price: P<?=  number_format((float)$row['price'], 2, '.', ',');?></h5>
                      <h5>Available: <?= $row['quantity']?></h5>
                      <h5>Product Description: <?= $row['description']?></h5>
                      <h5>Quantity:</h5><input class="form-control form-control-lg" type="number" placeholder="Quantity" name="quantity">
                      <br>
                      <div class="text-right"><input type="submit" value="ADD TO CART" class="btn btn-primary"></div>
                      <input type="hidden" name="product_id" value="<?= $pid?>">
                      <input type="hidden" name="buyer_id" value="<?= $id?>">
                      <input type="hidden" name="order_status" value="0">
                      <input type="hidden" name="seller_id" value="<?= $row['account_id']?>">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include('footer.php');?>