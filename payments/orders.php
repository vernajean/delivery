<?php 
    include('header.php');
    if (isset($_POST['approved'])) {
        $oid = $_GET['oid'];
        $query2 = "UPDATE delivery_db.orders SET order_status = 3 WHERE id = '$oid'";
        $result = $connection->query($query2);

        if($result) {
            $track = "got and approved your payment.";
            $track_sql = "INSERT INTO delivery_db.order_track (order_id, track, account_id) VALUES ('$oid','$track','$id')";
            mysqli_query($connection, $track_sql);
            // Add user login activity log
            $activity = 'Approved the payment.';
            $logSql = "INSERT INTO delivery_db.logs (account_id, activity) VALUES ('$id','$activity')";
            mysqli_query($connection, $logSql);
            echo "<script>
            alert('Order successfully completed.');
            window.location = 'orders.php';
            </script>";
        } else {
            echo "<script>
            alert('There\'s an error on completing the order.');
            window.location = 'orders.php';
            </script>";
        }
    }
?>
    <!--===========================   MAIN   =====================================-->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Product Information</th>
                    <th>Customer Information</th>
                    <th>Rider Information</th>
                    <th>Payment Information</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 
                    $query = "SELECT d.date_paid,a.*,r.fullname r_fullname,r.address r_address,r.contact_number r_contact_number,r.email r_email,o.*, o.id order_id,p.price,p.image,p.description,p.product_name FROM delivery_db.orders as o INNER JOIN delivery_db.product as p ON o.product_id = p.id INNER JOIN delivery_db.accounts as a ON a.id = o.buyer_id INNER JOIN delivery_db.accounts as r ON r.id = o.courier_id INNER JOIN delivery as d ON d.order_id = o.id WHERE o.order_status=5 OR o.order_status=3";
                    $result = $connection->query($query);
                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                    ?>
                      <tr>
                        <td>
                            <img src="<?= $base_url.'images/uploads/'.$row['image']?>" width="100px" alt="<?= $row['image']?>">
                            <br>
                            Product Name: <?= $row['product_name']?>
                            <br>
                            Price: P<?=  number_format((float)$row['price'], 2, '.', ',');?>
                            <br>
                            Quantity: <?= $row['quantity']?>
                        </td>
                        <td>
                            <?= $row['fullname']?>
                            <br>
                            <?= $row['contact_number']?>
                            <br>
                            <?= $row['address']?>
                            <br>
                            <?= $row['email']?>
                        </td>
                        <td>
                            <?= $row['r_fullname']?>
                            <br>
                            <?= $row['r_contact_number']?>
                            <br>
                            <?= $row['r_address']?>
                            <br>
                            <?= $row['r_email']?>
                        </td>
                        <td>
                            Price: P<?=  number_format((float)$row['price'], 2, '.', ',');?>
                            <br>
                            Quantity: <?= $row['quantity']?>
                            <br>
                            Delivery Fee: P55.00
                            <br>
                            Total Payment: P<?=  number_format((float)($row['price']+55), 2, '.', ',');?>
                            <br>
                            Date Paid: <?= $row['date_paid']?>
                        </td>
                        <td><span class="btn-warning" style="border-radius: 5px; padding: 3px 5px;">
                            <?php if($row['order_status'] == 1){
                                    echo 'Pending';
                                } elseif($row['order_status'] == 2){
                                    echo 'On Delivery';
                                } elseif($row['order_status'] == 3){
                                    echo 'Completed';
                                } elseif($row['order_status'] == 4){
                                    echo 'Declined';
                                } elseif($row['order_status'] == 5){
                                    echo 'Waiting for payment approval.';
                                }?> 
                        </span></td>
                        <td>
                            <?php if($row['order_status'] == 5){?>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-decline">Approve</button>
                            <div class="modal fade" id="modal-decline">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">SYSTEM ALERT!</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="orders.php?oid=<?= $row['order_id']?>" method="post">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                  <h4>Are you sure you recieved the exact amount?</h4>
                                                  <br>
                                                  <h4>
                                                  <center>
                                                      Price : P<?=  number_format((float)$row['price'], 2, '.', ',');?><br>
                                                      Quantity : <?= $row['quantity']?><br>
                                                      Delivery Fee : P55.00<br>
                                                      Total Payment : P<?=  number_format((float)($row['price'] + 55), 2, '.', ',');?>
                                                  </center>
                                                  </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <input type="submit" name="approved" class="btn btn-primary approved_btn" value="Approve">
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </td>
                      </tr>
                    <?php }}?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include('footer.php');?>