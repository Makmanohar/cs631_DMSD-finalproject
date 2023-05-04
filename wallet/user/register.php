<?php 

session_start();
error_reporting(0);
include('../dbconnection.php');
if(isset($_POST['submit']))
  {
    $fname=$_POST['fullname'];
    $mobno=$_POST['mobileno'];
    $email=$_POST['email'];
    $ssn=$_POST['ssn'];
    $password=$_POST['password'];

    $ret=mysqli_query($conn, "select email from user where email='$email' || mobileno='$mobno'");
    $result=mysqli_fetch_array($ret);
    if($result>0){
        $msg="This email or Contact Number already associated with another account";
    }
    else{
         $query=mysqli_query($conn, "insert into user (fullname, mobileno, email, password, ssn) VALUES ('$fname','$mobno','$email','$password','$ssn')");
        if ($query) {
        $msg="You have successfully registered";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }
}
}
 ?>
   <style>
      .card{
          max-width: 50%;
          left:28%;
      }
    </style>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    < script type = "text/javascript" >
        function checkpass() {
            if ($_POST['password'] != $_POST['repeatpassword']) {
                alert('Password and Repeat Password field does not match');
                document.signup.repeatpassword.focus();
                return false;
            }
            return true;
        }
    </script>

</head>


<body class="account-pages">
    <div class="container m-5 ">
        <div class="card">
            <div class="card-block">
                <div class="account-box">
                    <div class="card-box p-5">
                        <h3 class="text-uppercase text-center pb-4">
                            <a href="../index.php">
                                <span>Sign Up</span>
                            </a>
                        </h3>

                        <p style="font-size:16px; color:red" align="center"> <?php if($msg){echo $msg;}  ?> </p>

                        <form class="form-horizontal" action="" name="signup" method="post"
                            onsubmit="return checkpass();">
                            <div class="form-group row m-b-20">
                                <div class="col-12">
                                    <label for="username">Full Name</label>
                                    <input class="form-control" type="text" id="fullname" name="fullname" required=""
                                        placeholder="Enter Your Full Name">
                                </div>
                            </div>
                            <div class="form-group row m-b-20">
                                <div class="col-12">
                                    <label for="username">Mobile Number</label>
                                    <input class="form-control" type="text" id="mobileno" name="mobileno" required=""
                                        placeholder="Enter Your Mobile Number" maxlength="10" pattern="[0-9]+">
                                </div>
                            </div>
                            <div class="form-group row m-b-20">
                                <div class="col-12">
                                    <label for="emailaddress">Email address</label>
                                    <input class="form-control" type="email" id="email" name="email" required=""
                                        placeholder="Enter your email address">
                                </div>
                            </div>
                            <div class="form-group row m-b-20">
                                <div class="col-12">
                                    <label for="ssn">SSN *</label>
                                    <input class="form-control" type="number" required="" id="ssn" name="ssn"
                                        placeholder="Enter your SSN">
                                </div>
                            </div>
                            <div class="form-group row m-b-20">
                                <div class="col-12">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" required="" id="password"
                                        name="password" placeholder="Enter your password">
                                </div>
                            </div>
                            <div class="form-group row m-b-20">
                                <div class="col-12">
                                    <label for="password">Repeat Password</label>
                                    <input class="form-control" type="password" required="" id="repeatpassword"
                                        name="repeatpassword" placeholder="Enter your password">
                                </div>
                            </div>
                    </div>
                    <div class="form-group row text-center m-t-10">
                        <div class="col-12">
                            <button class="btn btn-dark" type="submit" name="submit">Sign Up Free</button>
                        </div>
                    </div>
                    </form>
                    <div class="row m-t-50">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">Already have an account? <a href="login.php"
                                    class="text-dark m-l-5"><b>Sign In</b></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>