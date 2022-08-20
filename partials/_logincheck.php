<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
    include '_dbconnect.php';
    $username=$_POST['username'];
    $password=$_POST['password'];
    $existSql="SELECT * FROM `users` WHERE `username`='$username'";
    $result=mysqli_query($conn,$existSql);
    $row=mysqli_fetch_assoc($result);
    $num=mysqli_num_rows($result);
    if($num==1){
        if(password_verify($password,$row['password'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['user_id']=$row['user_id'];
            $_SESSION['username']=$username;
            header('location:../index.php?loginsuccess=true');
            exit();
        }
    }
    header('location:../index.php?loginsuccess=false');
}
?>