<?php
session_start();
error_reporting(0);
include('../dbconnection.php');

if(isset($_POST['login']))
  {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = mysqli_query($conn,"select id from user where ( email = '$email') && password = '$password' ");
    $ret = mysqli_fetch_array($query);
    if($ret>0){
        $_SESSION['sid']=$ret['id'];
        //$cookie_id = $ret['id'];
       header('location:../account/account.php');
       //echo "Session id is ".  $_SESSION['sid'];
        
    }
    else{
        $msg="<div class='alert alert-danger' role='alert'>Invalid Details. Please try again!</div>";
    }
  }
  ?>