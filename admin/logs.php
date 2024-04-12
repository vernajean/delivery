<?php 
    include('header.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $data = $_POST;
        
        $uploaddir = '../images/uploads/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        // var_dump($uploadfile);exit;
        $data["image"] = $_FILES['image']['name'];

        $data["account_id"] = $id;

        $query = "INSERT INTO product ( " . implode(', ', array_keys($data)) . ") VALUES ('". implode("', '", array_values($data))."')";
        $result = $connection->query($query);
        if ($result) {
          if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
            // Add user login activity log
            $activity = 'Adding new product.';
            $logSql = "INSERT INTO aclogs (account_id, activity) VALUES ('$id','$activity')";
            mysqli_query($connection, $logSql);
            echo "<script>
            alert('Product added successfully');
            window.location = 'products.php';
            </script>";
          } else {
            echo "<script>
            alert('Upload Failed');
            window.location = 'products.php';
            </script>";
          }
        } else {
            echo "<script>
            alert('Adding Product unsuccessful');
            window.location = 'products.php';
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
              <!-- <div class="card-header">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add">
                    New Product
                </button>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Activity</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 
                    $sql = "SELECT a.username,l.* FROM aclogs as l INNER JOIN accounts as a ON a.id = l.account_id ORDER BY l.date_created DESC";
                    $result = $connection->query($sql);
                    if ($result->num_rows > 0) {
                        $count = 1;
                      while ($row = $result->fetch_assoc()) {
                    ?>
                      <tr>
                        <td><?= $count?></td>
                        <td><?= $row['username']?></td>
                        <td><?= $row['activity']?></td>
                        <td><?= $row['date_created']?></td>
                      </tr>
                    <?php $count++;}}?>
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

    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group mt-3">
                            <label>Upload Photo</label>
                            <div>
                                <input type="file" class="form-control border border-info" id="image" name="image" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label>Name</label>
                            <div>
                                <input type="text" class="form-control border border-info" name="product_name" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label>Description</label>
                            <div>
                                <textarea name="description" class="form-control border border-info" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label>Product Type</label>
                            <select name="product_type" class="select2 border border-info" width="100%">
                              <option>E-Toy</option>
                              <option>Product</option>
                              <option>Furniture</option>
                              <option>Goods</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label>Price</label>
                            <div>
                                <input type="text" name="price" class="form-control border border-info">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label>Quantity</label>
                            <div>
                                <input type="text" name="quantity" class="form-control border border-info">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
  <?php include('footer.php');?>