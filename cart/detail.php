<?php
if (session_id() === '') session_start();
include_once('../class/order.php');
include_once('../class/vegetable.php');
if(!isset($_SESSION['CustomerID'])){
    echo '<script> alert("Bạn phải đăng nhập mới sử dụng được chức năng này") </script>';
    echo "<script>window.location.href = 'http://localhost/marketonline/customer/login.php'</script>";
}
$order = new order();
$vege = new vegetable();
$detail = $order->getOrderDetail($_GET['orderID']);
$totalNum = 0;
$totalPrice = 0;
foreach ($detail as $key => $value) {
    $detail[$key]['img'] = $vege->getByID($value['VegetableID'])['Image'];
    $detail[$key]['name'] = $vege->getByID($value['VegetableID'])['VegetableName'];
    $totalNum += $value['Quantity'];
    $totalPrice += $value['Quantity'] * $value['Price'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css\bootstrap.css" />
    <script src="../css/jquery.min.js"></script>
    <style>
        .img {
            width: 15em;
            height: 10em;
            object-fit: cover;
        }
    </style>
</head>

<body id="body-content">
    <?php include('../menu.php') ?>
    <div class="container">
        <div>
            <h2>Cart</h2>
            <table class="table">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Image</td>
                        <td>Amout</td>
                        <td>Price</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 0;
                    foreach ($detail as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo ++$index ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td><img src="../<?php echo $value['img'] ?>" class="img"></td>
                            <td><?php echo $value['Quantity'] ?></td>
                            <td><?php echo $value['Price'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total:</td>
                        <td><?php echo $totalNum ?></td>
                        <td><?php echo number_format($totalPrice) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br><br>
</body>

</html>