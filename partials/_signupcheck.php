<?php
$showError=false;
if($_SERVER['REQUEST_METHOD']=="POST")
{
    include '_dbconnect.php';
    $username=$_POST['username'];
    $password=$_POST['password'];
    $username=str_replace('<','&lt;',$username);
    $username=str_replace('>','&gt;',$username);
    $password=str_replace('<','&lt;',$password);
    $password=str_replace('>','&gt;',$password);
    $cpassword=$_POST['cpassword'];
    $existSql="SELECT * FROM `users` WHERE `username`='$username'";
    $result=mysqli_query($conn,$existSql);
    $num=mysqli_num_rows($result);
    if($num==1){
        $showError='Username already exists';
    }
    else{
        if($password==$cpassword){
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`username`, `password`) VALUES ( '$username', '$hash')";
            $result=mysqli_query($conn,$sql);
            if($result){
                header('location:../index.php?signupsuccess=true');
                exit;
            }
        }
        else{
            $showError="Password is not same as confirm password.";
        }
    }
    header('location:../index.php?signupsuccess=false&error='.$showError);
}
?>