<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <?php
    include "partials/header.php";
    // session_start();
    if(isset($_SESSION['loggedin'])){
      echo '<div class="alert alert-success mb-0" role="alert">
      <h2><i>Welcome '.$_SESSION['username'].'!</i></h2>
    </div>';
    }
    else{
      echo '<div class="alert alert-warning mb-0" role="alert">
      <h2><i>Please login to continue!</i></h2>
    </div>';
    }
      ?>
    
    <div class="img mt-0">
    <div id="carouselExample" class="carousel slide">
      
  <div class="carousel-inner">
    <div class="carousel-item active ">
      <img src="/myForum/images/img4.jpeg" class="d-block img-fluid" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/myForum/images/img2.jpeg" class="d-block img-fluid" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/myForum/images/img5.jpeg" class="d-block img-fluid" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>
    <div class="container">
    <h2 class="text-center my-3">Let's discuss coding Forum</h2>
    <div class="row">
<?php
include 'partials/dbconnect.php';

  $sql="SELECT * FROM `categories`";
  $result=mysqli_query($conn,$sql);
  // $row=mysqli_fetch_assoc($result);
  // $num=mysqli_num_rows($result);
  // for($i=1;$i<=$num;$i++){

    while($row=mysqli_fetch_assoc($result)){
      $id=$row['category_id'];
    echo '<div class=" col-md-4 my-3 ">
    <div class="card" style="width: 18rem">
  <img src="images/'.$row['name'].'.png" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">'.$row['name'].'</h5>
    <p class="card-text">'.substr($row['description'],0,90).'...</p>
    <a href="thread.php?catid='.$id.'" class="btn btn-primary">Explore</a>
  </div>
  </div>
</div>';
// $row=mysqli_fetch_assoc($result);
}
?>
<!--  -->
</div>
</div>
    <?php include "partials/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>