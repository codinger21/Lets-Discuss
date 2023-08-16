
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Forum</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <style>
    /* #copy{
      min-height:650px;

    } */
    #bt{
      margin:0px;
    }
    .font{
        font-size:100
    }
    .nocmt{
      /* background-color:coral; */
      border-radius:10px;
      text-align:center;
      width:500px;
    }
    </style>
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
      <?php
      session_start();
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
       echo '<a class="btn btn-primary ms-3" href="logout.php" role="button">logout</a>';
    
      }
      else{
        echo '<a class="btn btn-primary ms-3" href="login.php" role="button">login</a>
        <a class="btn btn-primary ms-2" href="signup.php" type="submit" role="button">signup</a>';
      }?>
        <!-- <button class="btn btn-primary ms-3" type="submit" >login</button> -->
        <!-- <button class="btn btn-primary ms-2" type="submit">logout</button> -->
        <!-- <a class="btn btn-primary ms-3" href="login.php" type="submit" role="button">login</a> -->
        <!-- <a class="btn btn-primary ms-2" href="#" role="button">signup</a> -->
      </form>
    </div>
  </div>
</nav>
    </div>
  


</div>
<?php
  include 'partials/dbconnect.php';
  $id=$_GET['threadid'];
  $sql="SELECT * FROM `threads` WHERE `thread_id`='$id'";
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($result);
  $tuid=$row['thread_user_id'];
  $pql="SELECT * FROM `userinfo` WHERE `user_id`=$tuid";
  $j=mysqli_query($conn,$pql);
  $s=mysqli_fetch_assoc($j);
echo '
<div class="container" id="copy">
<div class="jumbotron mt-4 mb-5 py-3">
  <h2 class="display-6">'. $row['thread_title'].' Forums</h2>
  
  <hr class="my-4">
  <h3 class="font"><small><i>'.$row['thread_desc'].'</i></small></h3></hr>
  <p class="mb-3"><b><i>Posted by: '.$s['username'].'</i></b></p>
  </div>
  
 
  ';
  
$q="SELECT * FROM `comments` WHERE `thread_id`=$id";
$z=mysqli_query($conn,$q);
$i=mysqli_num_rows($z);

if($i>0){
  echo'<h2>Discussions</h2>';
  while($y=mysqli_fetch_assoc($z)){
    $ud=$y['comment_by'];
    $lsq="SELECT * FROM `userinfo` WHERE `user_id`=$ud";
    $p=mysqli_query($conn,$lsq);
    $c=mysqli_fetch_assoc($p);
    echo '
    
    <div class="media my-3">
    <img class="mr-3 my-1" src="images/profile.png" width="54px" alt="...">
    <div class="media-body">
    <strong>@'.$c['username'].'</strong>
      <h5 class="mt-0" ><small>'.$y['comment_content'].'</small></h5>
      </div>
    
    </div>';
  }
}
else{
  echo '
<div class=" nocmt container bg-info" id="copy">
<div class="jumbotron mt-4 mb-5 py-2 bg-info">
  <h4><small>Be the first to answer this query...</small></h4>
  
  </div>
  </div>
 
  ';
}
 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    $pc=false;
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $comment=$_POST['comment'];
      $user=$_SESSION['usrid'];
      // echo $user;
      $quer="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`) VALUES ('$comment', '$id', '$user')";
      $x=mysqli_query($conn,$quer);
      $pc=true;
      if($pc){
        echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Successfully uploaded the comment</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
      else{
        echo"<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Couldn't able to uplod the comment.lease try again after some time.</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
    }
  }
  else{
    echo"<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>please login to post comments.</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
  }
echo '</div>
<div class="container my-3">
  <form action="/myForum/discussion.php?threadid='.$id.' " method="post">
      <div class="mb-3 my-5">
        
      <h3>Post a comment</h3>
      <div class="form-floating">
      <textarea name="comment" class="form-control my-2" id="floatingTextarea2" style="height: 100px"></textarea>
      <label for="floatingTextarea2"></label>
    </div>
      </div>
      <button type="submit" class="form-control btn btn-primary">Submit</button>
    </form>
    </div>';
   
    ?>
    </div>
<div class="container-fluid bg-dark text-light mb-0" id="bt" >
    <p class="text-center">Copyright Lets Discuuss 2023 | All rights reserved</p>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>