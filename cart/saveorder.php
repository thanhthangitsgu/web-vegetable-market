<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (session_id() === '') session_start();
include_once('../class/order.php');
include_once('../class/vegetable.php');
$order = new order;
$vege = new vegetable();

if (!isset($_SESSION['CustomerID'])) {
    echo '<script> alert("Bạn phải đăng nhập mới sử dụng được chức năng này") </script>';
    echo "<script>window.location.href = 'index.php'</script>";
} else if($_GET['total']==0){
    echo '<script> alert("Giỏ hàng đang trống") </script>';
    echo "<script>window.location.href = 'index.php'</script>";
}else {
    $varOrder = array(
        'CustomerID' => $_SESSION['CustomerID'],
        'Date' => date('Y-m-d'),
        'Total' => $_GET['total'],
        'Note' => ''
    );
    $listOrder = array();
    foreach ($_SESSION['cart'] as $key => $value) {
        $varDetail = array(
            'VegetableID' => $key,
            'Quantity' => $value['amount'],
            'Price' => $value['price'],
        );
        array_push($listOrder, $varDetail);
        $varVege = $vege->getByID($key)['Amount'] - $value['amount'];
        $vege->updateByID($key, $varVege);
    }
    $order->addOrder($varOrder, $listOrder);

    //Làm trống giỏ hàng:
    unset($_SESSION['cart']);
    echo '<script> alert("Đặt hàng thành công");
    window.location.href = "index.php";</script>';
}
