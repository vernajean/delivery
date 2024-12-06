<?php include ('header.php'); ?>
<!--===========================   MAIN   =====================================-->

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-truck"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Deliveries</span>
              <span class="info-box-number">
                <?php
                $query = "SELECT * FROM orders WHERE courier_id = '$id' AND (order_status=2 OR order_status=3)";
                $result = $connection->query($query);
                echo $result->num_rows;
                ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        <div class="col-sm-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-truck"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Today's Deliveries</span>
              <span class="info-box-number">
                <?php
                date_default_timezone_set('Asia/Manila');
                $date = date('Y-m-d');
                $query = "SELECT * FROM orders WHERE courier_id = '$id' AND (order_status=2 OR order_status=3) AND DATE(date_created)='$date'";
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