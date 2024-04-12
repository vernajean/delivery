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
                    <span class="info-box-text">Total Completed Orders</span>
                    <span class="info-box-number">
                      <?php 
                        $query = "SELECT o.*,p.image,p.description,p.product_name FROM delivery_db.orders as o INNER JOIN delivery_db.product as p ON o.product_id = p.id WHERE o.order_status=3";
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
                    <span class="info-box-text">Payment to Accept</span>
                    <span class="info-box-number">
                      <?php 
                        date_default_timezone_set('Asia/Manila');
                        $date = date('Y-m-d');
                        $query = "SELECT o.*,p.image,p.description,p.product_name FROM delivery_db.orders as o INNER JOIN delivery_db.product as p ON o.product_id = p.id WHERE o.order_status=5";
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

  <?php include('footer.php');?>