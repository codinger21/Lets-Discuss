<?php
include 'partials/dbconnect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
  $name=$_POST['username'];
  $pass=$_POST['password'];
  $cpass=$_POST['confirmpassword'];
  $sql="SELECT * FROM `userinfo` WHERE `username`='$name'";
  $result=mysqli_query($conn,$sql);
  $num=mysqli_num_rows($result);
  if($num==0){
  if($pass==$cpass){
    $hash=password_hash($pass,PASSWORD_DEFAULT);
    $sql="INSERT INTO `userinfo`(`username`, `password`) VALUES ('$name', '$hash')";
    $result=mysqli_query($conn,$sql);
    if($result){
      echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Successfully created account</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    else{
      echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Couldn't connect to the server. Sorry for the inconvinence</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
  }
  else{
    echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Both passwords must be same</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
  }
}
else{
  echo"<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Username already exists</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
}
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="navi">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://localhost/myForum/#">Lets Discuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost/myForum/#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Contact</a>
        </li>
      </ul>
      
        <!-- <button class="btn btn-primary ms-3" type="submit" >login</button> -->
        <!-- <button class="btn btn-primary ms-2" type="submit">logout</button> -->
        <a class="btn btn-primary ms-3" href="login.php" type="submit" role="button">login</a>
        <!-- <a class="btn btn-primary ms-2" href="#" role="button">signup</a> -->
      </form>
    </div>
  </div>
</nav>
    </div>
  <div class="container">
  <form action="/myForum/signup.php" method="post">
    
  <div class="mb-3 my-3">
    <label for="username " class="form-label">Username</label>
    <input type="text" name="username" class="form-control " id="username" aria-describedby="username">
  <div class="mb-3 my-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 my-3">
    <label for="confirmpassword" class="form-label">Password</label>
    <input type="confirmpassword" name="confirmpassword" class="form-control" id="exampleInputPassword1">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>