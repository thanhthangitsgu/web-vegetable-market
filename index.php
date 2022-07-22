<?php
require_once('connection.php');
if (session_id() === '') session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="css\bootstrap.css"/> 
        <script src="css/jquery.min.js"></script>
    </head>
    <body id="body-content">
        <?php include('menu.php') ?> 
    </body>
</html>