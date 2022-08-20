<?php require('partials/_dbconnect.php');?>
<?php
$insert=false;
if($_SERVER['REQUEST_METHOD']=="POST"){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $title=str_replace('<','&lt;',$title);
    $title=str_replace('>','&gt;',$title);
    $description=str_replace('<','&lt;',$description);
    $description=str_replace('>','&gt;',$description);
    $userid=$_POST['userid'];
    $catid=$_GET['catid'];
    $sql="INSERT INTO `threads` (`thread_title`, `thread_description`, `category_id`, `user_id`) VALUES ('$title', '$description', '$catid', '$userid');";
    $result=mysqli_query($conn,$sql);
    if($result){
        $insert=true;
    }
}
?>

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
    <?php
    if($insert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your question is submitted successfully,Please wait for other\'s reactions.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <div class="container">

        <div class="jumbotron my-4 p-4">
            <?php
            $catid=$_GET['catid'];
            $sql="SELECT * FROM `categories` WHERE `category_id`=$catid";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $catname=$row['category_name'];
            $catdesc=$row['category_description'];
            ?>
            <h1 class="display-4">Welcome to <?php echo $catname;?></h1>
            <p class="lead"><?php echo $catdesc;?>
            </p>
            <hr class="my-4">
            <p>It is peer to peer forum to communicate with each other.If a topic is posted in a forum that is not
                appropriate for the question, the staff has the right to move that topic to another better suited
                forum.The posting of any copyrighted material on our web site is strictly prohibited.There will be no
                use of profanity on our message boards. This will not be tolerated and can lead to immediate suspension.
            </p>
            <a class="btn btn-primary btn-lg bg-success" href="#" role="button">Learn more</a>
        </div>
    </div>
    <hr>
    <div class="container">
        <h1>Start a discussion</h1>
        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
            // echo '<form action="threadlist.php?catid='.$cid.'" method="post">';
        echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title">
                <div class="form-text">Enter title small and crisp as possible.</div>
            </div>
            <input type="hidden" name="userid" value="'.$_SESSION['user_id'].'">
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>';
        }
        else{
            echo '<div class="alert alert-dark mb-0" role="alert">
            You are not loggedin,Please login to be able to start a discussion.
          </div>';
        }
        ?>
    </div>


    <hr>
    <div class="container" style="min-height:200px;">
        <h1>Discussion</h1>

        <?php
            $catid=$_GET['catid'];
            $sql="SELECT * FROM `threads` WHERE `category_id`=$catid;";
            $result=mysqli_query($conn,$sql);
            $noResult=true;
            while($row=mysqli_fetch_assoc($result)){
                $noResult=false;
                $tid=$row['thread_id'];
                $title=$row['thread_title'];
                $time=$row['time'];
                $description=$row['thread_description'];
                $user_id=$row['user_id'];
                $sql2="SELECT `username` FROM `users` WHERE `user_id`=$user_id";
                $result2=mysqli_query($conn,$sql2);
                $row2=mysqli_fetch_assoc($result2);
                echo '<div class="media my-3" style="display:flex">
                <img src="img/icon.png" height="64px"  class="mr-3 mx-2" alt="...">
                <div class="media-body mx-2">
                    <h5 class="mt-0"><a href="thread.php?tid='.$tid.'">'.$title.'</a></h5>
                    <p class="my-0">'.$description.'</p>
                    <p><b>'.$row2['username'].'</b> at '.$time .'</p>
                </div>
            </div>';
            }
            if($noResult){
                echo '<div class="alert alert-dark mb-0" role="alert">
                No result found.
              </div>
              <div class="alert alert-dark" role="alert">
                Be the first person to ask a question!
              </div>';
            }
            ?>

        <!-- For designing purpose -->
        <!-- <div class="media my-3" style="display:flex">
            <img src="img/icon.png" height="64px"  class="mr-3 mx-2" alt="...">
            <div class="media-body mx-2">
                <h5 class="mt-0">How to install pylab?</h5>
                <p>Will you do the same for me? It's time to face the music I'm no longer your muse. Heard it's
                    beautiful, be the judge and my girls gonna take a vote. I can feel a phoenix inside of me. Heaven is
                    jealous of our love, angels are crying from up above. Yeah, you take me to utopia.</p>
            </div>
        </div> -->
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