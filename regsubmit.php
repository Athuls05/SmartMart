<?php
include "config.php";

if(isset($_POST['submit']))
{
    $uname=$_POST['fname'];
    $email=$_POST['mail'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $usertype=$_POST['usertype'];
    $sql="INSERT INTO `tb_reg`(`username`, `email`, `phonenumber`, `password`, `confirm_password`, `usertype`) VALUES ('$uname','$email','$phone','$password','$password','$usertype')";
    $res=mysqli_query($link,$sql);
    header('location:login.php');
}
?>