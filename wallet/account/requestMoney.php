<?php
// connect to the database
require ('../dbconnection.php');
require ('../user/loginlogic.php');


?>

<!DOCTYPE html>
<html>

<head>
    <title>Request Money</title>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include 'navbar.php';?>

    <div class="container mt-3">
        <div id="alert"></div>
        <div class="card">
            <div class="card-body">
                <div class="jumbotron">
                    <h1 class="display-4 text-center">Request Money</h1>
                </div>
                </br>
                <form id="request-form" method="post">
                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $from = $_POST["from"];
                        $to = $_POST["to"];
                        $amount = $_POST["amount"];
                        $myID = $_SESSION['sid'];

                        // check if the to account exists
                        $query = "SELECT COUNT(*) AS count FROM accounts WHERE account_id = $to";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        $count = $row["count"];
                        if ($count == 0) {
                            echo "<div class='alert alert-danger' id ='invalid-alert' role='alert'>Invalid to account</div>";
                            echo "<script>setTimeout(function(){ $('#invalid-alert').fadeOut('slow'); }, 2000);</script>";

                            exit();
                        } else {
                            // add the request to the database
                            $query = "INSERT INTO requests (from_account, to_account, amount) VALUES ($myID, $to, $amount)";
                            mysqli_query($conn, $query);

                            echo "<div class='alert alert-success' id='success-alert' role='alert'>Money request sent successfully</div>";
                            echo "<script>setTimeout(function(){ $('#success-alert').fadeOut('slow'); }, 2000);</script>";

                        }
                    }?>
                    <div class="form-group m-b-20 row">
                        <div class="col-12">
                            <label for="to">Request To:</label>
                            <input class="form-control" type="text" id="to" name="to" required="">
                        </div>
                    </div>
                    <div class="form-group m-b-20 row">
                        <div class="col-12">
                            <label for="amount">Amount:</label>
                            <input class="form-control" type="text" id="amount" name="amount" required="">
                        </div>
                    </div>
                    <div class="form-group row text-center m-t-10 mt-3">
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" name="request">Request</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
</body>

</html>