<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <script src="../css/jquery.min.js"></script>
    
</head>
<body>
    <?php include('../menu.php') ?>
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <form method="POST" action="checkLogin.php">
                    <br>
                    <h3>Login</h3>
                    <div class="form-group">
                        <label for="login-id">Your's ID:</label>
                        <input type="text" class="form-control" name="id" id="login-id" placeholder="Your's ID">
                    </div>
                    <div class="form-group">
                        <label for="login-password">Password:</label>
                        <input type="password" class="form-control" name="password" id="login-password" placeholder="Password">
                    </div>
                    <input type="submit" class="btn btn-info" name="submit" value="Login" style="display:inline">
                    <a href="http://localhost/marketonline/customer/register.php" style='text-decoration: none; color:white'><span class="btn btn-info">Register</span></a>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>