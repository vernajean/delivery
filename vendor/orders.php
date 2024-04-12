<?php 
    include('header.php');
    if (isset($_POST['ready'])) {
        $oid = $_GET['oid'];
        $courier_id = $_POST['courier_id'];
        $query2 = "UPDATE orders SET order_status = 2, courier_id = '$courier_id' WHERE id = '$oid'";
        $result = $connection->query($query2);

        if($result) {
            $track = "successfully handed your item to the courier.";
            $track_sql = "INSERT INTO order_track (order_id, track, account_id) VALUES ('$oid','$track','$id')";
            mysqli_query($connection, $track_sql);

            // Add user login activity log
            $activity = 'Accept and handed the parcel to the courier.';
            $logSql = "INSERT INTO logs (account_id, activity) VALUES ('$id','$activity')";
            mysqli_query($connection, $logSql);
            echo "<script>
            alert('Parcel successfully handed to the courier.');
            window.location = 'orders.php';
            </script>";
        } else {
            echo "<script>
            alert('There\'s an error on updating data.');
            window.location = 'orders.php';
            </script>";
        }
    }

    if (isset($_POST['decline'])) {
      $oid = $_GET['oid'];
      $reason = $_POST['reason'];
      $query1 = "INSERT INTO declined_items(order_id,reason) VALUES('$oid','$reason')";
      $connection->query($query1);

      $query2 = "UPDATE orders SET order_status = 4, courier_id = '$courier_id' WHERE id = '$oid'";
      $result = $connection->query($query2);

      if($result) {
        // Add user login activity log
        $activity = 'Item has been declined.';
        $logSql = "INSERT INTO logs (account_id, activity) VALUES ('$id','$activity')";
        mysqli_query($connection, $logSql);
          echo "<script>
          alert('Item has been declined!');
          window.location = 'orders.php';
          </script>";
      } else {
          echo "<script>
          alert('There\'s an error on declining item.');
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
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 
                    $query = "SELECT o.*,o.id order_id,a.*,p.image,p.description,p.product_name,p.price,p.quantity pqty FROM orders as o INNER JOIN product as p ON o.product_id = p.id INNER JOIN accounts as a ON a.id = o.buyer_id WHERE o.seller_id = '$id' AND o.order_status <> 0";
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
                        <td><span class="btn-warning" style="border-radius: 5px; padding: 3px 5px;">
                            <?php if($row['order_status'] == 1){
                                    echo 'Pending';
                                } else if($row['order_status'] == 2){
                                    echo 'On Delivery';
                                } else if($row['order_status'] == 3){
                                    echo 'Completed';
                                } else if($row['order_status'] == 4){
                                    echo 'Declined';
                                }?> 
                        </span></td>
                        <td>
                            <?php if($row['order_status'] == 1){?>
                            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-ready">Ready to Deliver</button>
                            <div class="modal fade" id="modal-ready">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">SELECT COURIER</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="orders.php?oid=<?= $row['order_id']?>" method="post">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select name="courier_id" class="select2">
                                                    <?php $query1 = "SELECT * FROM accounts WHERE usertype = 'Courier'";
                                                    $result1 = $connection->query($query1);
                                                    if ($result1->num_rows > 0) {
                                                    while ($row1 = $result1->fetch_assoc()) { ?>
                                                        <option value="<?= $row1['id']?>"><?= $row1['fullname']?></option>
                                                        <?php }}?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" name="ready" class="btn btn-primary">Submit</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-decline">Decline</button>
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
                                                  <label for="">Reason:</label>
                                                  <textarea name="reason" cols="30" rows="10" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <input type="submit" name="decline" class="btn btn-primary" value="Submit">
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