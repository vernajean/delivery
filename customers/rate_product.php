<?php include('header.php');
    $oid = $_GET['oid'];
    if(isset($_POST['submit_comment'])){
        $rating = $_POST['r1'];
        $comment = $_POST['comments'];

        $sql = "INSERT INTO ratings ( order_id, rating, comments, account_id) VALUES ('$oid','$rating','$comment','$id')";
        mysqli_query($connection, $sql);

        if ($result) {
            // Add user login activity log
            $activity = 'Rate a product.';
            $logSql = "INSERT INTO logs (account_id, activity) VALUES ('$id','$activity')";
            mysqli_query($connection, $logSql);
            echo "<script>
            alert('Successfully rated the product!');
            window.location = 'my_orders.php';
            </script>";
        } else {
            echo "<script>
            alert('Rating the product unsuccessful!');
            window.location = 'my_orders.php';
            </script>";
        }
    }
?>
    <!--===========================   MAIN   =====================================-->

<div class="content-wrapper bg-pink">
    <section class="content-header">
      <div class="container-fluid">
      </div>
    </section>
    <section class="content" style="color: black;margin: 0% 26%;">
      <div class="container-fluid">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h4>Rate this Product</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <?php 
                        $query = "SELECT o.quantity,p.image,p.description,p.price,p.product_name FROM orders as o INNER JOIN product as p ON o.product_id = p.id WHERE o.id = '$oid'";
                        $result = $connection->query($query);
                        $row = $result->fetch_assoc();
                    ?>
                    <th>
                        <div class="row">
                            <div class="col-sm-6 text-right">
                                <img src="<?= $base_url.'images/uploads/'.$row['image']?>" style="width: 200px;">
                            </div>
                            <div class="col-sm-6">
                                <span>Product Name: <?= $row['product_name']?></span><br>
                                <span>Price per Item: P<?=  number_format((float)$row['price'], 2, '.', ',');?></span>
                            </div>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                    <form action="rate_product.php?oid=<?= $oid?>" method="post">
                    <tr>
                        <td>
                            <center><label>Ratings</label></center>
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-2">
                                    <div class="form-group clearfix">
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" value="1" name="r1" checked="">
                                        <label for="radioPrimary1">
                                            1
                                        </label>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group clearfix">
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" value="2" name="r1" checked="">
                                        <label for="radioPrimary2">
                                            2
                                        </label>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group clearfix">
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary3" value="3" name="r1" checked="">
                                        <label for="radioPrimary3">
                                            3
                                        </label>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group clearfix">
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary4" value="4" name="r1" checked="">
                                        <label for="radioPrimary4">
                                            4
                                        </label>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group clearfix">
                                      <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary5" value="5" name="r1" checked="checked">
                                        <label for="radioPrimary5">
                                            5
                                        </label>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-sm-1"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center><label>Comment/s</label></center>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group clearfix">
                                      <textarea name="comments" class="form-control" row="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" name="submit_comment" class="btn btn-success">
                                </div>
                            </div>
                        </td>
                    </tr>
                    </form>
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