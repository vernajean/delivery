<?php 
    include('header.php');
    if (isset($_POST['reset'])) {
        $id = $_GET['id'];
        $password = md5('12345');
        $query2 = "UPDATE accounts SET password = '$password' WHERE id = '$id'";
        // var_dump($query2);exit;
        $result = $connection->query($query2);

        if($result) {
            // Add user login activity log
            $activity = 'Password has been reset.';
            $logSql = "INSERT INTO logs (account_id, activity) VALUES ('$id','$activity')";
            mysqli_query($connection, $logSql);
            echo "<script>
            alert('Password has been reset. The new password is 12345.');
            window.location = 'users.php';
            </script>";
        } else {
            echo "<script>
            alert('There\'s an error on resetting password.');
            window.location = 'users.php';
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
                    <th>ID</th>
                    <th>Fullname</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>User Type</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 
                    $query = "SELECT * FROM accounts WHERE usertype <> 'Admin'";
                    $result = $connection->query($query);
                    if ($result->num_rows > 0) {
                        $count = 1;
                      while ($row = $result->fetch_assoc()) {
                    ?>
                      <tr>
                        <td>
                            <?= $count;?>
                        </td>
                        <td>
                            <?= $row['fullname']?>
                        </td>
                        <td>
                            <?= $row['address']?>
                        </td>
                        <td>
                            <?= $row['email']?>
                        </td>
                        <td>
                            <?= $row['contact_number']?>
                        </td>
                        <td>
                            <?= $row['usertype']?>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-reset<?= $row['id']?>">Reset Password</button>
                            <div class="modal fade" id="modal-reset<?= $row['id']?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">SYSTEM ALERT!!</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="users.php?id=<?= $row['id']?>" method="post">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    Are you sure you want to reset the password?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                            <button type="submit" name="reset" class="btn btn-primary">Yes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- <br>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-decline">Delete</button>
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
                                                  Are you sure you want to delete this account?
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
                            </div> -->
                        </td>
                      </tr>
                    <?php $count++;}
                    
                }?>
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