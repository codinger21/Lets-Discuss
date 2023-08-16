<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="http://localhost/myForum/#">Lets Discuss</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="true">
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
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li> 
            </ul>
            <form class="d-flex" role="search" action="search.php" method="get">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">

                <button class="btn btn-primary" type="submit">Search</button>
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
            </form>
        </div>
    </div>
</nav>