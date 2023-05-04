<?php
require ('../dbconnection.php');
?>


<!DOCTYPE html>
<html>

<head>
    <title>Send/Receive Money</title>
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
        <div class="card">
            <div class="card-body">
                <div class="jumbotron">
                    <h1 class="display-4 text-center">Money Transfer</h1>
                </div>
                <div>
                    </br>
                    <form class="form-horizontal" action="transac.php" method="post">
                        <?php 

                        function generateTransactionId() {
                            $alphabet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $length = strlen($alphabet);
                            $trans_id = '';
                            for ($i = 0; $i < 10; $i++) {
                                $trans_id .= $alphabet[rand(0, $length - 1)];
                            }
                            return $trans_id;
                        }

                        //check if the form has been submitted
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $from = $_POST["from"];
                            $to = $_POST["to"];
                            $amount = $_POST["amount"];
                            
                            //check if the from account has enough balance
                            $query = "SELECT account_id,balance FROM accounts WHERE account_id = $from";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            $balance = $row["balance"];
                            $account_id = $row["account_id"];
                            if ($balance < $amount) {
                                echo "<div class='alert alert-danger' role='alert' id='invalid-alert'>Insufficient balance</div>";
                                echo "<script>setTimeout(function(){ $('#invalid-alert').fadeOut('slow'); }, 2000);</script>";
                                exit();
                            } else {
                                    $transaction_id = generateTransactionId();
                                    $currentDateTime = date('Y-m-d H:i:s');
                                    //transfer money from the from account to the to account
                                    $query = "UPDATE accounts SET balance = balance - $amount WHERE account_id = $from";
                                    mysqli_query($conn, $query);
                                    $query = "UPDATE accounts SET balance = balance + $amount WHERE account_id = $to";
                                    mysqli_query($conn, $query);

                                    if (mysqli_affected_rows($conn) > 0) {
                                        echo "<div class='alert alert-success' role='alert' id='success-alert'>Money transferred successfully</div>";
                                        echo "<script>setTimeout(function(){ $('#success-alert').fadeOut('slow'); }, 2000);</script>";
                                    } else {
                                        echo "<div class='alert alert-danger' role='alert' id='failure-alert'>Money transfer failed</div>";
                                        echo "<script>setTimeout(function(){ $('#failure-alert').fadeOut('slow'); }, 2000);</script>";
                                    }
                                    //Update transaction
                                    $updateTransQuery = "INSERT INTO `transactions`(`trans_id`, `sender_id`, `receiver_id`, `amount`, `time_date`) VALUES ('$transaction_id','$from','$to','$amount', '$currentDateTime')";
                                    mysqli_query($conn, $updateTransQuery);
                                }
                            }
                        
                ?>
                        <div class="form-group m-b-20 row">
                            <div class="col-12">
                                <label for="from">From Account:</label>
                                <input class="form-control" type="number" id="from" name="from" required=""
                                    value="<?php echo $account_id;?>">
                            </div>
                        </div>
                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="to">To Account:</label>
                                <input class="form-control" type="number" required="" id="to" name="to">
                            </div>
                        </div>
                        <div class="form-group row m-b-20">
                            <div class="col-12">
                                <label for="amount">Amount:</label>
                                <input class="form-control" type="number" required="" id="amount" name="amount">
                            </div>
                        </div>
                        <div class="form-group row text-center m-t-10 mt-3">
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit" name="Transfer">Transfer</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
</body>

</html>