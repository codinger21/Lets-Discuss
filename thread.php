<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Forum</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<style>
#copy {
    min-height: 450px;

}

#bt {
    margin: 0px;
}
</style>

<body>
    <div class="navi">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="http://localhost/myForum/#">Lets Discuss</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
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
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Contact</a>
                        </li>
                    </ul>

                    <!-- <button class="btn btn-primary ms-3" type="submit" >login</button> -->
                    <!-- <button class="btn btn-primary ms-2" type="submit">logout</button> -->
                    <?php
        session_start();
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
         echo '<a class="btn btn-primary ms-3" href="logout.php" role="button">logout</a>';
      
        }
        else{
          echo '<a class="btn btn-primary ms-3" href="login.php" role="button">login</a>
          <a class="btn btn-primary ms-2" href="signup.php" type="submit" role="button">signup</a>';
        }
        ?>
                    <!-- <a class="btn btn-primary ms-3" href="login.php" type="submit" role="button">login</a> -->
                    < </form>
                </div>
            </div>
        </nav>
    </div>



    </div>

    <?php
  include 'partials/dbconnect.php';
  $id=$_GET['catid'];
  $sql="SELECT * FROM `categories` WHERE `category_id`=$id";
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($result);
  $show=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
  $que=$_POST['question'];
  $desc=$_POST['desc'];
  // $userid=$_POST
  $rrd=$_SESSION['usrid'];
  $desc=str_replace("<","&lt;",$desc);
  $desc=str_replace(">","&gt;",$desc);
  $sql2="INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES ('$que', '$desc', '$id', '$rrd')";
  $res=mysqli_query($conn,$sql2);
  $show=true;
  if($show){
    echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Successfully uploaded the question</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
  }

else{
  echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Couldn't able to upload the question. Please try again after some time</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
}
}
echo '
<div class="container">
<div class="jumbotron my-3 py-3">
  <h1 class="display-4">Welcome to '. $row['name'].' Forums</h1>
  <p class="lead my-4">&emsp;&ensp;&ensp;<i>'.$row['description'].'</i></p>
  <hr class="my-4">
  <p>Share your knowledge. Dont hold back in sharing your knowledge – its likely someone will find it useful or interesting. When you give information, provide your sources.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </p>
  </div>
  
  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#askQuestion">
  <h4><i>Ask Question...</i></h4>
</button>

<!-- Modal -->
<div class="modal fade" id="askQuestion" tabindex="-1" aria-labelledby="askQuestionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="askQuestionLabel">Discussion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">';
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
         echo '<form action="/myForum/thread.php?catid='.$id.' " method="post">
         <div class="mb-3">
           <label for="question" class="form-label">Ask your question here</label>
           <input type="text" name="question" class="form-control" id="question" aria-describedby="Help">
           <div id="question" class="form-text">Make sure your question in short and crisp.</div>
         </div>
         <div class="mb-3">
         Write you concern here
         <div class="form-floating">
         <textarea name="desc" class="form-control my-2" id="floatingTextarea2" style="height: 100px"></textarea>
         <label for="floatingTextarea2"></label>
       </div>
         </div>
         <button type="submit" class="form-control btn btn-primary">Submit</button>
       </form>';
      
        }
        else{
          echo"<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>please login to continue!!!</strong>
        <button type='button' class='btn' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
        }
        echo'
      
      </div>
      
    </div>
  </div>
</div>
    </div>
  <h2>Browse Quesions</h2>';
  $sql1="SELECT * FROM `threads` WHERE `thread_cat_id`=$id";
  $result=mysqli_query($conn,$sql1);
  $tnum=mysqli_num_rows($result);
  echo'<div class="container" id="copy">';
 
  if($tnum>0){
    while($row=mysqli_fetch_assoc($result)){
      $userid=$row['thread_user_id'];
      $a="SELECT * FROM `userinfo` WHERE `user_id`=$userid";
      $t=mysqli_query($conn,$a);
      $f=mysqli_fetch_assoc($t);
    echo '
    <div class="media my-3">
  <img class="mr-3 my-2" src="images/profile.png" width="65px" alt="...">
  <div class="media-body">
  <strong>@'.$f['username'].'</strong>
    <h5 class="mt-1" ><a class="text-dark" href="discussion.php?threadid='.$row['thread_id'].'">'.$row['thread_title'].'</a></h5>'.$row['thread_desc'].'
    </div>
  </div>
';
  }
}
else{
  echo '<div class="alert alert-light display-6" role="alert">
  No Questions to Browse!!!
</div>';
}
echo'</div>
</div>';

?>

    <div class="container-fluid bg-dark text-light mb-0" id="bt">
        <p class="text-center">Copyright Lets Discuuss 2023 | All rights reserved</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>