<?php include('header.php');?>
    <!--===========================   MAIN   =====================================-->

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
                    <span class="info-box-text">Number of Users</span>
                    <span class="info-box-number">
                      <?php 
                        $query = "SELECT * FROM accounts WHERE usertype <> 'Admin'";
                        $result = $connection->query($query);
                        echo $result->num_rows;
                      ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-sm-4">
                <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Number of Products</span>
                    <span class="info-box-number">
                      <?php 
                        $query = "SELECT * FROM product";
                        $result = $connection->query($query);
                        echo $result->num_rows;
                      ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
            </div>
            <!-- <div class="col-sm-4">
                <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-bag"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Today's Sales</span>
                    <span class="info-box-number">
                      <?php 
                        date_default_timezone_set('Asia/Manila');
                        $date = date('Y-m-d');
                        $query = "SELECT o.*,p.image,p.description,p.product_name FROM orders as o INNER JOIN product as p ON o.product_id = p.id WHERE o.seller_id = '$id' AND o.order_status=3 AND DATE(date_created)='$date'";
                        $result = $connection->query($query);
                        echo $result->num_rows;
                      ?>
                    </span>
                </div>
                </div>
            </div> -->
        </div>
      </div>
    </section>
  </div>

  <?php include('footer.php');?>