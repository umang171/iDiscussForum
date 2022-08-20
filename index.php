<?php require('partials/_dbconnect.php');?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>iDiscuss-Coding Forum</title>

</head>

<body>

    <?php require('partials/_header.php');?>


    <!-- Carousel -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/carousal1.jpg" width="1000px" height="450px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/carousal2.jpg" width="1000px" height="450px" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/carousal3.jpg" width="1000px" height="450px" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Categories -->
    <div class="container">
        <h1 class="text-center">iDiscuss-Browse categories</h1>
        <div class="row">

        <?php
        $sql="select * from categories";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $cname=$row['category_name'];
            $cdescription=$row['category_description'];
            $cid=$row['category_id'];
            // echo $row['category_name'];
            // echo $row['category_description'];
            echo '<div class="col-md-4 my-2">
            <div class="card" style="width: 18rem;">
                <img src="https://source.unsplash.com/500x400/?programming,coding,'.$cname.'" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><a href="threadlist.php?catid='.$cid.'">'.$cname.'</a></h5>
                    <p class="card-text">'.substr($cdescription,0,120).'...</p>
                    <a href="threadlist.php?catid='.$cid.'" class="btn btn-primary">View Thread</a>
                </div>
            </div>
        </div>
';
        }
        ?>
            
        </div>

    </div>
    <?php require('partials/_footer.php');?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
</body>

</html>