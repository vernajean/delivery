<?php 
    include('header.php');
    if (isset($_POST["submit"])) {
        $data = $_POST;
        $uploaddir = '../images/uploads/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        // var_dump($uploadfile);exit;
        $data["image"] = $_FILES['image']['name'];

        $data["account_id"] = $id;
        unset($data['submit']);
        $query = "INSERT INTO product ( " . implode(', ', array_keys($data)) . ") VALUES ('". implode("', '", array_values($data))."')";
        $result = $connection->query($query);
        if ($result) {
          if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
            // Add user login activity log
            $activity = 'Adding new product.';
            $logSql = "INSERT INTO logs (account_id, activity) VALUES ('$id','$activity')";
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

    if (isset($_POST["edit"])) {
        $pid = $_GET['pid'];
        $product_name = $_POST['product_name']; 
        $quantity = $_POST['quantity']; 
        $description = $_POST['description']; 
        // $product_type = $_POST['product_type']; 
        $price = $_POST['price']; 

        $query = "UPDATE product SET product_name = '$product_name',quantity = '$quantity',description = '$description',price = '$price' WHERE id='$pid'";
        // var_dump($query);exit;
        $result = $connection->query($query);
        if ($result) {
            // Add user login activity log
            $activity = 'Update the product.';
            $logSql = "INSERT INTO logs (account_id, activity) VALUES ('$id','$activity')";
            mysqli_query($connection, $logSql);
            echo "<script>
            alert('Product updated successfully');
            window.location = 'products.php';
            </script>";
        } else {
            echo "<script>
            alert('Updating Product unsuccessful');
            window.location = 'products.php';
            </script>";
        }
    }



    if (isset($_POST["delete"])) {
        $pid = $_GET['pid'];

        $query = "UPDATE product SET deleted_product = 1 WHERE id='$pid'";
        // var_dump($query);exit;
        $result = $connection->query($query);
        if ($result) {
            // Add user login activity log
            $activity = 'Delete a product.';
            $logSql = "INSERT INTO logs (account_id, activity) VALUES ('$id','$activity')";
            mysqli_query($connection, $logSql);
            echo "<script>
            alert('Product deleted successfully');
            window.location = 'products.php';
            </script>";
        } else {
            echo "<script>
            alert('Deleting product unsuccessful');
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
              <div class="card-header">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add">
                    New Product
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 
                    $sql = "SELECT * FROM product WHERE account_id = '$id' AND deleted_product <> 1";
                    $result = $connection->query($sql);
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                    ?>
                      <tr>
                        <td><img src="<?= $base_url.'images/uploads/'.$row['image']?>" width="100px" alt="<?= $row['image']?>"></td>
                        <td><?= $row['product_name']?></td>
                        <td><?= $row['description']?></td>
                        <td><?= $row['product_type']?></td>
                        <td>P<?=  number_format((float)$row['price'], 2, '.', ',');?></td>
                        <td><?= $row['quantity']?></td>
                        <td>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit">Edit</button>
                          <div class="modal fade" id="modal-edit">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">New Product</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="products.php?pid=<?= $row['id']?>" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group mt-3">
                                                <label>Name</label>
                                                <div>
                                                    <input type="text" class="form-control border border-info" name="product_name" autocomplete="off" value="<?= $row['product_name']?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Description</label>
                                                <div>
                                                    <textarea name="description" class="form-control border border-info" cols="30" rows="10"><?= $row['description']?></textarea>
                                                </div>
                                            </div>
                                           <!--  <div class="form-group mt-3">
                                                <label>Product Type</label>
                                                <select name="product_type" class="select2 border border-info" width="100%">
                                                      <option selected><?= $row['product_type']?></option>
                                                      <option>E-Toy</option>
                                                      <option>Product</option>
                                                      <option>Furniture</option>
                                                      <option>Goods</option>
                                                </select>
                                            </div> -->
                                            <div class="form-group mt-3">
                                                <label>Price</label>
                                                <div>
                                                    <input type="text" name="price" class="form-control border border-info" value="<?=$row['price']?>">
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Quantity</label>
                                                <div>
                                                    <input type="number" name="quantity" class="form-control border border-info" value="<?= $row['quantity']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" name="edit" value="Update">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete">Delete</button>
                          <div class="modal fade" id="modal-delete">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">SYSTEM ALERT!</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="products.php?pid=<?= $row['id']?>" method="post">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                  <h4>Are you sure you want to delete this product?</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <input type="submit" name="delete" class="btn btn-danger" value="Delete">
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
                        <input type="submit" class="btn btn-primary" name="submit" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
  <?php include('footer.php');?>