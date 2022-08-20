<?php require('partials/_dbconnect.php');?>

<?php
$insert=false;
if($_SERVER['REQUEST_METHOD']=="POST"){    
    $comment=$_POST['comment'];
    $comment=str_replace('<','&lt;',$comment);
    $comment=str_replace('>','&gt;',$comment);
    $username=$_POST['username'];
    $tid=$_GET['tid'];
    $sql="INSERT INTO `comments` (`comment_content`, `comment_by`, `thread_id`) VALUES ('$comment', '$username', '$tid');";
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
        <strong>Success!</strong> Your comment has been posted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>

    <div class="container">

        <div class="jumbotron my-4 p-4">
            <?php
            $tid=$_GET['tid'];
            $sql="SELECT * FROM `threads` WHERE `thread_id`=$tid";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $title=$row['thread_title'];
            $desc=$row['thread_description'];
            $time=$row['time'];
            $user_id=$row['user_id'];
            $sql2="SELECT `username` FROM `users` WHERE `user_id`=$user_id";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);    
            ?>
            <h1 class="display-4"><?php echo $title;?></h1>
            <p class="lead"><?php echo $desc;?>
            </p>
            <hr class="my-4">
            <p>It is peer to peer forum to communicate with each other.If a topic is posted in a forum that is not
                appropriate for the question, the staff has the right to move that topic to another better suited
                forum.The posting of any copyrighted material on our web site is strictly prohibited.There will be no
                use of profanity on our message boards. This will not be tolerated and can lead to immediate suspension.
            </p>
            <p>Posted by:<b><?php echo $row2['username'].'</b> at '.$time ?></p>
        </div>
    </div>
    <hr>
    <div class="container">
        <h1>Post a comment</h1>
        <?php
            $tid=$_GET['tid'];
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
            // echo '<form action="threadlist.php?catid='.$cid.'" method="post">';
        echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
        <div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
        </div>
        <input type="hidden" name="username" value="'.$_SESSION['username'].'">
        <button type="submit" class="btn btn-success">Submit</button>
        </form>';
        }
        else{
            echo '<div class="alert alert-dark mb-0" role="alert">
            You are not loggedin,Please login to be able to post a comment.
          </div>';
        }
        ?>
    </div>

    <hr>
    <div class="container" style="min-height:200px;">
        <h1>Comments</h1>

        <?php
            $tid=$_GET['tid'];
            $sql="SELECT * FROM `comments` WHERE `thread_id`=$tid;";
            $result=mysqli_query($conn,$sql);
            $noResult=true;
            while($row=mysqli_fetch_assoc($result)){
                $noResult=false;
                $tid=$row['thread_id'];
                $comment=$row['comment_content'];
                $user=$row['comment_by'];
                $time=$row['time'];
                echo '<div class="media my-3" style="display:flex">
                <img src="img/icon.png" height="64px"  class="mr-3 mx-2" alt="...">
                <div class="media-body mx-2">                    
                    <h5 class="mt-0"><b>'.$user.'</b> at '.$time.'</h5>
                    <p>'.$comment.'</p>
                </div>
            </div>';
            }
            if($noResult){
                echo '<div class="alert alert-dark mb-0" role="alert">
                No result found.
              </div>
              <div class="alert alert-dark" role="alert">
                Be the first person to comment!
              </div>';
            }
            ?>
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