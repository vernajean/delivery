<?php
include('header.php');
if (isset($_POST['payment'])) {
  $oid = $_GET['oid'];
  // $payment_method = $_POST['payment_method'];
  // $amount = $_POST['amount'];
  // $reference_number = $_POST['reference_number'];

  $query2 = "UPDATE orders SET order_status = 3 WHERE id = '$oid'";
  $connection->query($query2);

  // $query = "INSERT INTO courier_delivery (`order_id`, `payment_method`, `amount`, `reference_number`) VALUES ('$oid','$payment_method','$amount','$reference_number')";
  // $result = $connection->query($query);
  // if ($result) {
  //   $track = "got your payment and ready to remit.";
  //   $track_sql = "INSERT INTO order_track (order_id, track, account_id) VALUES ('$oid','$track','$id')";
  //   mysqli_query($connection, $track_sql);

  //   // Add user login activity log
  //   $activity = 'Item paid successfully.';
  //   $logSql = "INSERT INTO logs (account_id, activity) VALUES ('$id','$activity')";
  //   mysqli_query($connection, $logSql);
  //   echo "<script>
  //           alert('Parcel paid successfully!');
  //           window.location = 'my_deliveries.php';
  //           </script>";
  // } else {
  //   echo "<script>
  //           alert('There\'s an error on payment process!');
  //           window.location = 'my_deliveries.php';
  //           </script>";
  // }
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
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-6 text-center">
        <form method="post" action="export.php">
          <button type="submit" name="export" class="btn btn-primary">Export</button>
        </form>
      </div>
      <div class="col-md-6 text-center">
        <form method="post" enctype="multipart/form-data" action="import.php">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" name="file">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>
          <button type="submit" name="import" class="btn btn-success mt-3">Import</button>
        </form>
      </div>
    </div>
  </div>

  </thead>
  <tbody>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead style="background-color: #283130; color: white;">
                    <tr>
                      <th>Product Information</th>
                      <th>Customer Information</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $query = "SELECT o.*,o.id order_id,a.*,p.image,p.description,p.product_name,p.price,p.quantity pqty FROM orders as o INNER JOIN product as p ON o.product_id = p.id INNER JOIN accounts as a ON a.id = o.buyer_id WHERE courier_id = '$id' AND (order_status=2 OR order_status=3 OR order_status=5)";
                    $result = $connection->query($query);
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                          <td>
                            <img src="<?= $base_url . 'images/uploads/' . $row['image'] ?>" width="100px"
                              alt="<?= $row['image'] ?>">
                            <br>
                            Product Name: <?= $row['product_name'] ?>
                            <br>
                            Price: P<?= number_format((float) $row['price'], 2, '.', ','); ?>
                            <br>
                            Quantity: <?= $row['quantity'] ?>
                          </td>
                          <td>
                            <?= $row['fullname'] ?>
                            <br>
                            <?= $row['contact_number'] ?>
                            <br>
                            <?= $row['address'] ?>
                            <br>
                            <?= $row['email'] ?>
                          </td>
                          <td><span class="btn-warning" style="border-radius: 5px; padding: 3px 5px;">
                              <?php if ($row['order_status'] == 2) {
                                echo 'Pending';
                              } else if ($row['order_status'] == 3) {
                                echo 'Completed';
                              } else if ($row['order_status'] == 4) {
                                echo 'Declined';
                              } ?>
                            </span></td>
                          <td>
                            <?php if ($row['order_status'] == 2) { ?>
                              <form action="my_deliveries.php?oid=<?= $row['order_id'] ?>" method="post">
                                <button type="submit" name="payment" class="btn btn-primary">Confirm</button>
                              </form>
                            <?php } ?>
                          </td>
                        </tr>
                      <?php }
                    } ?>
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


<?php include('footer.php'); ?>