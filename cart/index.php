<?php
if (session_id() === '') session_start();
require('../class/vegetable.php');
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] === 'buy') {
        $flag = $_REQUEST['id'];
        if (isset($_SESSION['cart'][$_REQUEST['id']])) {
            $_SESSION['cart'][$_REQUEST['id']]['amount']++;
        } else {
            $_SESSION['cart'][$_REQUEST['id']]['amount'] = 1;
        }
        $_SESSION['cart'][$_REQUEST['id']]['name'] = $_REQUEST['name'];
        $_SESSION['cart'][$_REQUEST['id']]['img'] = $_REQUEST['img'];
        $_SESSION['cart'][$_REQUEST['id']]['price'] = str_replace(',','',$_REQUEST['price']);
    }
}
/**
 * Tính tổng số lượng sản phẩm trong giỏ hàng
 */
function totalOfAmout()
{
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $total += $value['amount'];
    }
    return $total;
}
/**
 * Tính tổng tiền sản phẩm
 */
function totalOfPrice()
{
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $total += $value['amount'] *$value['price'];
    }
    return $total;
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
                        <td>Picture</td>
                        <td>Amout</td>
                        <td>Price</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 0;
                    foreach ($_SESSION['cart'] as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo ++$index ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td><img src=<?php echo $value['img'] ?> class="img"></td>
                            <td><?php echo $value['amount'] ?></td>
                            <td><?php echo $value['price'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo totalOfAmout() ?></td>
                        <td><?php echo number_format(totalOfPrice()) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="saveorder.php?total=<?php echo totalOfPrice() ?>"><span class="btn btn-danger" id='order'>Order</span></a>
    </div>
    <br><br>
</body>

</html>