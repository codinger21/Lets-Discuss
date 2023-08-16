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
    include "partials/dbconnect.php";
    $res=$_GET['search'];
    $sql="SELECT * FROM threads WHERE thread_title LIKE '%$res%' ";
    $result=mysqli_query($conn,$sql);
    $s=false;
    echo '<div class="container">
    <h2 class="mt-3 mb-3">Search results for "'.$res.'"</h2>';
    while($row=mysqli_fetch_assoc($result)){

    $s=true;
    echo '
    
    <h4 class="my-1"><a href="discussion.php?threadid='.$row['thread_id'].'" class="text-dark">'.$row['thread_title'].'</a></h4>
    <p>'.$row['thread_desc'].'
    </p>
    
    ';
    
    }
    if(!$s){
      echo '<div class="jumbotron my-3 py-3">
  <h1 class="display-4">No results found</h1>
  
  <hr class="my-4">
  <p>       Suggestions:
      <ul>
 <li> Make sure that all words are spelled correctly.</li>
  <li>Try different keywords.</li>
  <li>Try more general keywords.</li>
  <li>Try fewer keywords.</li></ul></p>
  
  </div>';
    }
    echo '</div>';
 include "partials/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>