<?php
require ('../dbconnection.php');
require ('../user/loginlogic.php');

if(isset($_POST['update']))
{
    $fname=$_POST['fullname'];
    $mobno=$_POST['mobileno'];
    $email=$_POST['email'];
    $sql = "UPDATE `user` SET `fullname`='$fname', `mobileno`='$mobno', `email`='$email' WHERE id=".$_SESSION['sid'];
    $ret = mysqli_query($conn, $sql);
    if ($ret) {
        $msg = "<div class='alert alert-success' role='alert'>Update successful</div>";
    }else{
        $msg = "<div class='alert alert-danger' role='alert'>Update failed</div>";
    }
    

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Account Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .jumbotron {
        background-color: #f5f5f5;
        padding: 50px;
        margin-bottom: 0px;
    }

    .card {
        margin-bottom: 30px;
        border: none;
        border-radius: 0px;
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #6c757d;
        color: white;
        font-size: 1.2em;
    }

    .card-header h2 {
        margin-bottom: 0px;
    }

    .card-body {
        padding: 30px;
    }

    .table th {
        border-top: none;
    }
    </style>
</head>

<body>
    <?php include 'navbar.php';?>


    <div class="container">
        <div class="jumbotron m-3">
            <h1 class="display-4 text-center">Account Information</h1>
        </div>
        <div class="container">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    style="float: right" ;>Edit</button>
            <?php

                $sql = "SELECT user.fullname, user.mobileno, user.email, accounts.account_id, accounts.account_type, accounts.balance \n"
                . "FROM user \n"
                . "INNER JOIN accounts ON user.ssn = accounts.account_ssn\n"
                . "where user.id =".  $_SESSION['sid'];
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);
                } else {
                    echo "No results found.";
                }
            ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h2>Personal Information</h2>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Name:</th>
                                    <td><?php echo $user_data['fullname']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td><?php echo $user_data['email']; ?></td>
                                </tr>
                                <tr>
                                    <th>Mobile Number:</th>
                                    <td><?php echo $user_data['mobileno']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h2>Account Details</h2>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Account Number:</th>
                                    <td><?php echo $user_data['account_id']; ?></td>
                                </tr>
                                <tr>
                                    <th>Account Type:</th>
                                    <td><?php echo $user_data['account_type']; ?></td>
                                </tr>
                                <tr>
                                    <th>Balance:</th>
                                    <td><?php echo '$' . number_format($user_data['balance'], 2); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                 <?php if($msg){ echo "<div class='alert' role='alert'>".$msg."</div>";}  ?> </p>

                    <form class="form-horizontal" action="" name="update" method="post">
                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="username">Full Name</label>
                                <input class="form-control" type="text" id="fullname" name="fullname" required=""
                                    value="<?php echo $user_data['fullname']?>">
                            </div>
                        </div>
                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="username">Mobile Number</label>
                                <input class="form-control" type="text" id="mobileno" name="mobileno" required=""
                                    value="<?php echo $user_data['mobileno']; ?>" maxlength="10" pattern="[0-9]+">
                            </div>
                        </div>
                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control" type="email" id="email" name="email" required=""
                                    value="<?php echo $user_data['email']?>">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update" style="float: right;">Update</button>

                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>