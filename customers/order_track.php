<?php include('header.php');
    $oid = $_GET['oid'];
?>
    <!--===========================   MAIN   =====================================-->

<div class="content-wrapper bg-pink">
    <section class="content-header">
      <div class="container-fluid">
      </div>
    </section>
    <section class="content" style="color: black">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h4>Order Tracks</h4>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <?php 
                        $query = "SELECT o.quantity,p.image,p.description,p.price,p.product_name FROM orders as o INNER JOIN product as p ON o.product_id = p.id WHERE o.id = '$oid'";
                        $result = $connection->query($query);
                        $row = $result->fetch_assoc();
                    ?>
                    <th>
                        <div class="row">
                            <div class="col-sm-3 text-right">
                                <img src="<?= $base_url.'images/uploads/'.$row['image']?>" style="width: 200px;">
                            </div>
                            <div class="col-sm-3">
                                <span>Product Name: <?= $row['product_name']?></span><br>
                                <span>Number of Items: <?= $row['quantity']?></span><br>
                                <span>Price per Item: P<?=  number_format((float)$row['price'], 2, '.', ',');?></span>
                            </div>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                    <?php $query1 = "SELECT ot.*,a.fullname,a.usertype FROM order_track as ot INNER JOIN accounts as a ON a.id = ot.account_id WHERE ot.order_id = '$oid'";
                    
                        $result1 = $connection->query($query1);
                        while ($row1 = $result1->fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <h5>
                            (<span><?= $row1['date_added']?></span>)
                            <span><?= $row1['account_id'] == $id ? "You." : $row1['fullname'].' ('.$row1['usertype'].')';?></span>
                            <span><?= $row1['track']?></span>
                            </h5>
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