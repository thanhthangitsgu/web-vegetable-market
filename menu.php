<?php
if (session_id() === '') session_start();
?>
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="http://localhost/marketonline/index.php">Market online</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav" id="menu">
                <a class="nav-item nav-link" href="http://localhost/marketonline/vegetable/index.php">Vegetable</a>
                <a class="nav-item nav-link" href="http://localhost/marketonline/cart/index.php">Cart</a>
                <a class="nav-item nav-link" href="http://localhost/marketonline/customer/login.php" id="login" hidden>Login</a>
                <a class="nav-item nav-link logined" href="http://localhost/marketonline/cart/history.php" hidden>History</a>
                <a class="nav-item nav-link logined" href="../customer/logout.php" hidden>Logout</a>
                <span class="btn btn-info text-dark logined" hidden id="nameUser"><?php echo $_SESSION['Fullname']?></span>
            </div>
        </div>
    </nav>
</div>
<?php
if (isset($_SESSION['CustomerID'])) {
    echo '<script> $(".logined").removeAttr("hidden");</script>';
}else{
    echo '<script> $("#login").removeAttr("hidden"); </script>';
}
?>