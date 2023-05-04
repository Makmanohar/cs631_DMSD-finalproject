<?php 
require_once 'loginlogic.php'; ?>
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
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</head>


<body class="account-pages" style="max-width=50px;">
    <div class="container m-5" >
        <div class="card">
            <div class="card-block">
                <div class="account-box">
                    <div class="card-box p-5">
                        <h3 class="text-uppercase text-center pb-4">
                            <a href="../index.php"><span>Login</span></a>
                        </h3>
                        <p style="font-size:16px; color:red" align="center"> <?php if($msg){
                            $msg;
                            }  ?> </p>
                        <form class=""  action="" name="login" method="post"> 
                            <div class="form-group m-b-20 row">
                                <div class="col-12">
                                    <label for="emailaddress">Email address</label>
                                    <input class="form-control" type="text" id="email" name="email" required=""
                                        placeholder="Registered Email or Contact Number">
                                </div>
                            </div>
                            <div class="form-group row m-b-20">
                                <div class="col-12">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" required="" id="password"
                                        name="password" placeholder="Enter your password">
                                </div>
                            </div>
                            <div class="form-group row text-center m-t-10 mt-3">
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit"
                                        name="login">Sign In</button>
                                </div>
                            </div>
                        </form>
                        <div class="row m-t-50">
                            <div class="col-sm-12 text-center">
                                <p class="text-muted">Don't have an account? <a href="register.php"
                                        class="text-dark m-l-5"><b>Sign Up</b></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>