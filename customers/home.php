<?php include('header.php');?>
    <!--===========================   MAIN   =====================================-->

<div class="content-wrapper bg-pink">
    <section class="content-header">
      <div class="container-fluid">
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <?php 
            $pt = @$_GET['pt'];
            if($pt==NULL){
              $sql = "SELECT * FROM product";
            } else {
              $sql = "SELECT * FROM product WHERE product_type = '$pt'";
            }
            $result = $connection->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if($row['quantity'] > 0){  
                ?>
            <div class="col-sm-3">
              <a href="<?= $base_url.'customers/products.php?pid='.$row['id'];?>" style="color:black">
                <div class="info-box">
                  <div class="info-box-content">
                    <img src="<?= $base_url.'images/uploads/'.$row['image']?>" alt="<?= $row['image']?>" style="width: 100%;height:200px;">
                    <h4 class="info-box-text"><?= $row['product_name']?></h4>
                    <h5 class="info-box-text"><?= $row['description']?></h5>
                    <?php 
                    $product_id = $row['id'];
                    $sql1 = "SELECT SUM(rating) as rate FROM ratings as r INNER JOIN orders as o ON r.order_id = o.id WHERE o.product_id = '$product_id'";
                    $result1 = $connection->query($sql1);
                    $row1 = $result1->fetch_assoc();
                    $rate = $row1["rate"];
                    ?>
                    <h5 class="info-box-text">Ratings: <?= $result1->num_rows == null ? 'No Rating.' : ($rate/$result1->num_rows)?>/5</h5>
                  </div>
                </div>
              </a>
            </div>
          <?php }}}?>
        </div>
      </div>
    </section>
  </div>

  <?php include('footer.php');?>