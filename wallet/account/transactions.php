<?php 
require ('../dbconnection.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
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

<body>
    <?php include 'navbar.php';?>
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <form method="get">
                    <div class="form-group row">
                        <label for="query" class="col-sm-2 col-form-label">Search Query:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="query" name="query"
                                placeholder="Transaction ID, Sender/Receiver ID">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start_date" class="col-sm-2 col-form-label">Start Date:</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <label for="end_date" class="col-sm-2 col-form-label">End Date:</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
//require ('../dbconnection.php');

            //retrieve transactions
            $query = "SELECT * FROM transactions";

            //apply search filters if provided
            if (isset($_GET['query']) && $_GET['query'] != '') {
            $query .= " WHERE trans_id LIKE '%".$_GET['query']."%' OR sender_id LIKE '%".$_GET['query']."%' OR receiver_id LIKE '%".$_GET['query']."%'";
            }
            if (isset($_GET['start_date']) && $_GET['start_date'] != '') {
            $query .= " AND time_date >= '".$_GET['start_date']."'";
            }
            if (isset($_GET['end_date']) && $_GET['end_date'] != '') {
            $query .= " AND time_date <= '".$_GET['end_date']."'";
            }

            $result = mysqli_query($conn, $query);
            ?>

    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <div class="jumbotron">
                    <h1 class="display-4 text-center">Transaction History</h1>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Transaction ID</th>
                                <th>Sender ID</th>
                                <th>Receiver ID</th>
                                <th>Amount</th>
                                <th>Date/Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['trans_id']; ?></td>
                                <td><?php echo $row['sender_id']; ?></td>
                                <td><?php echo $row['receiver_id']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $row['time_date']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</body>

</html>