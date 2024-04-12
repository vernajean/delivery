<?php 
    include('header.php');
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
                    <th>Payment Information</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 
                    $query = "SELECT o.*,d.*,o.id order_id,a.*,p.image,p.description,p.product_name,p.price,p.quantity pqty FROM orders as o INNER JOIN product as p ON o.product_id = p.id INNER JOIN accounts as a ON a.id = o.buyer_id LEFT JOIN delivery as d ON o.id = d.order_id WHERE o.seller_id = 1 AND (order_status=2 OR order_status=3)";
                    $result = $conn->query($query);
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
                            Name: <?= $row['fullname']?>
                            <br>
                            Phone Number: <?= $row['contact_number']?>
                            <br>
                            Address: <?= $row['address']?>
                            <br>
                            Email: <?= $row['email']?>
                        </td>
                        <td>
                            Payment Method: <?= $row['payment_method'];?>
                            <br>
                            Amount: P<?= number_format((float)$row['amount'], 2, '.', ',');?>
                            <?php if($row['payment_method'] == 'GCash'){ echo '
                            <br>Reference Number: '.$row['reference_number'];}?>
                            <br>
                            Date Paid: <?= $row['date_paid']?>
                        </td>
                        <td><span class="btn-warning" style="border-radius: 5px; padding: 3px 5px;">
                            <?php  if($row['order_status'] == 2){
                                    echo 'For Payment';
                                } else if($row['order_status'] == 3){
                                    echo 'Completed';
                                } if($row['order_status'] == 4){
                                    echo 'Declined';
                                }?> 
                        </span></td>
                        <td>
                            <?php if($row['order_status'] == 2){?>
                            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-ready">Process Payment</button>
                            <div class="modal fade" id="modal-ready">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">PAYMENT PROCESS</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="my_deliveries.php?oid=<?= $row['order_id']?>" method="post">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                  <center>
                                                  <img src="<?= $base_url.'images/uploads/'.$row['image']?>" alt="<?= $row['image']?>" style="width:100%">
                                                  <h5>Product Name: <?= $row['product_name']?></h5>
                                                  <h5>Quantity: <?= $row['quantity']?></h5>
                                                  <h5>Price: P<?=  number_format((float)$row['price'], 2, '.', ',');?></h5>
                                                  <h5>Payment: P<?=  number_format((float)($row['price'] * $row['quantity']), 2, '.', ',');?></h5>
                                                  <h5>Delivery Fee: P55.00</h5>
                                                  <h5>Grand Total: P<?=  number_format((float)(($row['price'] * $row['quantity'])+55), 2, '.', ',');?></h5>
                                                  </center>
                                                  <div class="form-group">
                                                    <label>Payment Method</label>
                                                    <select name="payment_method" class="select2" id="payment_method">
                                                      <option disabled>Select Payment Method</option>
                                                      <option>Cash</option>
                                                      <option>GCash</option>
                                                    </select>
                                                  </div>
                                                  <div id="gcash_reference_number" hidden>
                                                    <div class="form-group">
                                                      <label>GCash Account Name : </label>
                                                      <label>Kriseth C.</label>
                                                    </div>
                                                    <div class="form-group">
                                                      <label>GCash Number : </label>
                                                      <label>09104050601</label>
                                                    </div>
                                                    <div class="form-group">
                                                      <label>GCash Reference Number</label>
                                                      <input type="text" class="form-control" placeholder="Enter GCash Reference Number" name="reference_number">
                                                    </div>
                                                  </div>
                                                  
                                                  <div class="form-group" id="gcash_reference_number">
                                                    <label>Amount</label>
                                                    <input type="text" class="form-control" placeholder="Enter Amount" name="amount">
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" name="payment" class="btn btn-primary" disabled>Submit</button>
                                            <input type="hidden" value="<?=  ($row['price'] * $row['quantity'])+55;?>" name="hid_total_payment">
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