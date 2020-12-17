<?php
$conn = new mysqli("localhost","root","","carousel");
$msg = '';

if(isset($_POST['upload'])){
    $image = $_FILES['image']['name'];
    $path = 'image/'.$image;
    $sql = $conn->query("INSERT INTO slider (image_path) VALUES ('$path')");
    if($sql){
        move_uploaded_file($_FILES['image']['tmp_name'],$path);
        $msg = 'image uploaded seccessfully';
    }
    else{
        $msg = 'failed to upload';
    }
}

$result = $conn->query("SELECT image_path from slider ORDER BY id DESC LIMIT 3");
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="author" content="sahil">
        <meta http-equiv="X-UA-compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
<title>carousal</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

 <body>
     <h2 class="text-center bg-dark text-light pb-2">News</h2>
    <div class="container-fluid">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
            <div id="demo" class="carousel slide" data-ride="carousel">

<!-- Indicators -->
<ul class="carousel-indicators">
  <?php
  $i = 0;
  foreach ($result as $row){
      $actives = '';
      if($i == 0){
          $actives = 'active';
      }
  
  ?>
  <li data-target="#demo" data-slide-to="<?= $i; ?>" class="<?= $actives; ?>"></li>
  <?php $i++; } ?>
</ul>

<!-- The slideshow -->
<div class="carousel-inner">
    <?php
  $i = 0;
  foreach ($result as $row){
      $actives = '';
      if($i == 0){
          $actives = 'active';
      }
  
  ?>
  <div class="carousel-item <?= $actives; ?>">
    <img src="<?= $row['image_path'] ?>" width="100%" height="150">
  </div>
  <?php $i++; } ?>
</div>

<!-- Left and right controls -->
<a class="carousel-control-prev" href="#demo" data-slide="prev">
  <span class="carousel-control-prev-icon"></span>
</a>
<a class="carousel-control-next" href="#demo" data-slide="next">
  <span class="carousel-control-next-icon"></span>
</a>

</div>

            </div>
        </div>
      <div class="row justify-content-center">
          <div class="col-lg-4 bg-dark rounded px-4">
              <h4 class="text-center text-light p-1">select image to upload</h4>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                  <input type="file" name="image" class="form-contol p-1" required>
              </div>
              <div class="form-group">
                  <input type="submit" name="upload" class="btn-btn-warning btn-block" value="upload image">
              </div>
              <div class="form-group">
                  <h5 class="text-center text-light"><?= $msg; ?></h5>
              </div>
           </form>
          </div>
     </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>