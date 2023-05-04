<?php
// connect to the database
require ('../dbconnection.php');
require ('../user/loginlogic.php');

if (isset($_POST['accept_request'])) {
    $from_account = $_POST['from'];
    $to_account = $_POST['to'];
    $amount = $_POST['amount'];
    
    $sql = "SELECT balance FROM accounts WHERE account_id = $from_account";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $balance = $row['balance'];
    // Debit amount from the account
    if ($balance > $amount) {
        $new_balance = $balance - $amount;
        $sql = "UPDATE accounts SET balance = $new_balance WHERE account_id = $from_account";
        $result = mysqli_query($conn, $sql);

        $new_balance = $balance + $amount;
        $sql = "UPDATE accounts SET balance = '$new_balance' WHERE account_id = '$to_account'";
        $result = mysqli_query($conn, $sql);
  
      } else {
        echo "Update failed";
      }
    
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Received requests</title>
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

    <div class="container">

        <div class="card mt-3">
            <div class="card-body">
                <div class="jumbotron">
                    <h1 class="display-4 text-center">Received Requests</h1>
                </div>

                <?php

                    // check if the form has been submitted
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $from = $_POST["from"];
                        $to = $_POST["to"];
                        $amount = $_POST["amount"];

                        // check if the from account has sufficient balance
                        $query = "SELECT balance FROM accounts WHERE account_id =". $_SESSION['sid'];
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                        $balance = $row["balance"];
                        if ($balance < $amount) {
                            echo "<div class='alert alert-danger' role='alert'>Insufficient balance! Try again!</div>";
                            exit();
                        } else {
                            // update the balances of the from and to accounts
                            $query = "UPDATE accounts SET balance = balance - $amount WHERE account_id = $from";
                            mysqli_query($conn, $query);

                            $query = "UPDATE accounts SET balance = balance + $amount WHERE account_id = $to";
                            mysqli_query($conn, $query);

                            // delete the request from the database
                            $query = "DELETE FROM requests WHERE from_account = $from AND to_account = $to AND amount = $amount";
                            mysqli_query($conn, $query);

                            echo "<div class='alert alert-success' id='request-accepted' role='alert'>Money request accepted</div>";
                            echo "<script>setTimeout(function(){ $('#request-accepted').fadeOut('slow'); }, 2000);</script>";

                        }
                    }
                    
                    ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Request From</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    // fetch the received requests from the database
                                    $logged_in_user_id = $_SESSION['sid'];
                                    $query = "SELECT * FROM requests WHERE to_account =" .$logged_in_user_id;

                                    $result = mysqli_query($conn, $query);

                                    // loop through the results and display each request
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $from_account = $row["from_account"];
                                        $amount = $row["amount"];
                                ?>
                            <tr>
                                <td><?php echo $from_account; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td>
                                    <form method="post" action="receivedRequest.php">
                                        <input type="hidden" name="from" value="<?php echo $logged_in_user_id; ?>">
                                        <input type="hidden" name="to" value="<?php echo $to; ?>">
                                        <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                                        <button type="submit" class="btn btn-primary"
                                            name="accept_request">Accept</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>