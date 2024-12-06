<?php include('header.php');

    if (isset($_POST['proceed'])) {
        $oid = $_GET['oid'];
        $query1 = "SELECT p.quantity,p.id FROM orders as o INNER JOIN product as p ON o.product_id = p.id WHERE o.id = '$oid'";
        $row = $connection->query($query1)->fetch_assoc();
        $pid = $row['id'];
        $new_quantity = $row['quantity'] - $_POST['hid_quantity'];
        $query2 = "UPDATE product SET quantity = '$new_quantity' WHERE id = '$pid'";
        $connection->query($query2);
        // var_dump($new_quantity);exit;
        $query = "UPDATE orders SET order_status = 1 WHERE id = '$oid'";
        $result = $connection->query($query);

        $track = "Bought an item.";
        $track_sql = "INSERT INTO order_track (order_id, track, account_id) VALUES ('$oid','$track','$id')";
        mysqli_query($connection, $track_sql);

        if ($result) {
            // Add user login activity log
            $activity = 'Bought an item.';
            $logSql = "INSERT INTO logs (account_id, activity) VALUES ('$id','$activity')";
            mysqli_query($connection, $logSql);
            echo "<script>
            alert('Product bought successfully!');
            window.location = 'my_orders.php';
            </script>";
        } else {
            echo "<script>
            alert('Buying product unsuccessful!');
            window.location = 'my_orders.php';
            </script>";
        }
    }

    if (isset($_POST['remove_yes'])) {
        // var_dump('dada');exit;
        $oid = $_GET['oid'];
        $query = "DELETE FROM orders WHERE id = '$oid'";
        $result = $connection->query($query);
        if ($result) {
            // Add user login activity log
            $activity = 'Removed an item in his/her cart.';
            $logSql = "INSERT INTO aclogs (account_id, activity) VALUES ('$id','$activity')";
            mysqli_query($connection, $logSql);
            echo "<script>
            alert('Product removed at your cart successfully!');
            window.location = 'my_orders.php';
            </script>";
        } else {
            echo "<script>
            alert('Removing product unsuccessful!');
            window.location = 'my_orders.php';
            </script>";
        }
    }
?>
    <!--===========================   MAIN   =====================================-->

<div class="content-wrapper bg-light yellow">
    <section class="content-header">
      <div class="container-fluid">
      </div>
    </section>
    <section class="content" style="color: black">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Date Added</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                    $st = @$_GET['st'];
                    if($st == 'cart'){
                        $query = "SELECT o.*,p.image,p.description,p.price,p.product_name FROM orders as o INNER JOIN product as p ON o.product_id = p.id WHERE o.buyer_id = '$id' AND o.order_status = 0  ORDER BY o.date_created DESC";
                    } else {
                        $query = "SELECT o.*,p.image,p.description,p.price,p.product_name FROM orders as o INNER JOIN product as p ON o.product_id = p.id WHERE o.buyer_id = '$id' ORDER BY o.date_created DESC";
                    }
                    
                    $result = $connection->query($query);
                    while ($row = $result->fetch_assoc()) {
                        $order_id1 = $row['id'];
                    ?>
                    <tr>
                        <td><img src="<?= $base_url.'images/uploads/'.$row['image']?>" width="100px" alt="<?= $row['image']?>"></td>
                        <td><?= $row['product_name']?></td>
                        <td><?= $row['quantity']?></td>
                        <td>P<?=  number_format((float)$row['price'], 2, '.', ',');?></td>
                        <td>P<?=  number_format((float)($row['price'] * $row['quantity']), 2, '.', ',');?></td>
                        <td><?= $row['date_created']?></td>
                        <td>
                            <?php 
                                if($row['order_status'] == 0){
                                    echo 'In cart';
                                } else if($row['order_status'] == 1){
                                    echo 'Seller manage your parcel.';
                                }else if($row['order_status'] == 2){
                                    echo 'On Delivery';
                                }else if($row['order_status'] == 3){
                                    echo 'Completed';
                                }else  if($row['order_status'] == 4){
                                    echo 'Declined';
                                } else  if($row['order_status'] == 5){
                                    echo 'Waiting for payment approval';
                                }
                            ?>
                        </td>
                        <td>
                        <?php if($row['order_status'] == 0){?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buy">Buy Now</button>
                            <div class="modal fade" id="modal-buy">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">System Alert!</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="my_orders.php?oid=<?= $row['id']?>" method="post">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <img src="<?= $base_url.'images/uploads/'.$row['image']?>" alt="<?= $row['image']?>" style="width:100%">
                                                        <h5>Product Name: <?= $row['product_name']?></h5>
                                                        <h5>Quantity: <?= $row['quantity']?></h5>
                                                        <h5>Price: P<?=  number_format((float)$row['price'], 2, '.', ',');?></h5>
                                                        <h5>Payment: P<?=  number_format((float)($row['price'] * $row['quantity']), 2, '.', ',');?></h5>
                                                        <h5>Delivery Fee: P55.00</h5>
                                                        <h5>Grand Total: P<?=  number_format((float)(($row['price'] * $row['quantity'])+55), 2, '.', ',');?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-success" name="proceed" value="Proceed">
                                                <input type="hidden" name="hid_quantity" value="<?= $row['quantity']?>">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modal-remove">Remove</button>
                            <div class="modal fade" id="modal-remove">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">System Alert!</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="my_orders.php?oid=<?= $row['id']?>" method="post">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h4>Are you sure you want to remove this item?</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" name="remove_yes" class="btn btn-danger">Yes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <a href="<?= $base_url.'customers/order_track.php?oid='.$order_id1?>" class="btn btn-primary">Track</a>
                            <a href="<?= $base_url.'customers/rate_product.php?oid='.$order_id1?>" class="btn btn-success">Rate</a>
                        <?php    }?>
                        </td>
                    </tr>
                    <?php    }?>
                </table>
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
        </div>
      </div>
    </section>
  </div>

  <?php include('footer.php');?>