<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">iDiscuss</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Category
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            <form class="d-flex" action="search.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" id="search" name="search" aria-label="Search">
                <button class="btn bg-success" type="submit">Search</button>
            </form>
            <?php
            session_start();
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
            $username=$_SESSION['username'];
            echo '
            <p class="my-0 mx-2" style="color:white;">Welcome '.$username.'!</p>
            <div>
            <a href="partials/_logout.php" class="btn btn-outline-success">Log out</a>
            </div>';
        }
        else{
            
            echo ' <div>
            <button class="btn btn-outline-success mx-2" data-bs-toggle="modal"
                data-bs-target="#loginModal">Login</button>
            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">Sign
                up</button>
        </div>';
        }
        ?>

           
        </div>
    </div>
</nav>

<?php
    include '_login.php';
    include '_signup.php';


    if(isset($_GET['signupsuccess'])&&$_GET['signupsuccess']=="true")
    {
        echo '<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
        <strong>Success! </strong> Your account has been succesfully created.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if(isset($_GET['loginsuccess'])&&$_GET['loginsuccess']=="true")
    {
        echo '<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
        <strong>Success! </strong> You are successfully loggedin.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if(isset($_GET['signupsuccess'])&&$_GET['signupsuccess']=="false")
    {
        $error=$_GET['error'];
        echo '<div class="alert alert-danger my-0 alert-dismissible fade show" role="alert">
        <strong>Sorry! </strong>'. $error.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if(isset($_GET['loginsuccess'])&&$_GET['loginsuccess']=="false")
    {
        echo '<div class="alert alert-danger my-0 alert-dismissible fade show" role="alert">
        <strong>Sorry! </strong> Your username and password did not match.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>