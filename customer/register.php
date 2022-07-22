<?php
include('../connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap.css"/>
    <script src="../css/jquery.min.js"></script>
</head>
<body>
    <?php include('../menu.php') ?>
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <form method="POST" action="saveRegister.php">
                    <br>
                    <h3>Register</h3>
                    <div class>
                        <label for="reg-fullname">Your's Fullname:</label>
                        <input type="text" class="form-control" name="fullname" id="reg-fullname" required>
                    </div>
                    <div>
                        <label for="reg-password">Password:</label>
                        <input type="password" class="form-control" name="password" id="reg-password" required>
                    </div>
                    <div >
                        <label for="reg-address">Address:</label>
                        <input type="text" class="form-control" name="address" id="reg-address" required>
                    </div>
                    <div class="form-group">
                        <label for="reg-city">City:</label>
                        <input type="text" class="form-control" name="city" id="reg-city" required>
                    </div>
                    <button type="submit" class="btn btn-info" name="submit">Register</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>