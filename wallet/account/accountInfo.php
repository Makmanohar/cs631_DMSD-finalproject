<?php
require ('../dbconnection.php');
require ('../user/loginlogic.php');
$msg="";
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
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>
<style>
.card {
    max-width: 70%;
    left: 20%;
}
</style>

<body>

    <?php include 'navbar.php';?>
    <?php
        $query = mysqli_query($conn,"select * FROM `user` WHERE id =". $_SESSION['sid'] );
        $row = mysqli_fetch_assoc($query);
        mysqli_close($conn);
    ?>
    <div class="container mt-3">
        <div class="card ">
            <div class="card-body">
                <div class="jumbotron">
                    <h1 class="display-4 text-center">Welcome <?php echo $row['fullname']?></h1>
                </div>
                </br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    style="float: right" ;>Edit</button>
                <p  style="font-family:verdana">Mobile: <?php echo $row['mobileno']; ?></p>
                <p  style="font-family:verdana">Email: <?php echo $row['email']; ?></p>
                <p  style="font-family:verdana">SSN: <?php echo $row['ssn']; ?></p>
            </div>
        </div>
    </div>

    <!-- Modal -->
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
                                    value="<?php echo $row['fullname']?>">
                            </div>
                        </div>
                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="username">Mobile Number</label>
                                <input class="form-control" type="text" id="mobileno" name="mobileno" required=""
                                    value="<?php echo $row['mobileno']; ?>" maxlength="10" pattern="[0-9]+">
                            </div>
                        </div>
                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control" type="email" id="email" name="email" required=""
                                    value="<?php echo $row['email']?>">
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
    </div>
</body>

</html>