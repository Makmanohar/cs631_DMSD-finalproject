<style>
    .nav-link{
        color: white;
    }
    .navbar{
        color: white;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" >E-Wallet</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="account.php">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="transac.php">Send money</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="requestMoney.php">Request money</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="receivedRequest.php">Received request</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="transactions.php">Statements</a>
                </li>
            </ul>
        </div>
    </div>
    <div>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="../user/logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>