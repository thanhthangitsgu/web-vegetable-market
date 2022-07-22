<?php
if (session_id() === '') session_start();
include('../class/order.php');
if(!isset($_SESSION['CustomerID'])){
    echo '<script> alert("Bạn phải đăng nhập mới sử dụng được chức năng này") </script>';
    echo "<script>window.location.href = 'http://localhost/marketonline/customer/login.php'</script>";
}
$ord = new order();
$allOrder = $ord->getAllOrder($_SESSION['CustomerID']);
if ($allOrder == null) $allOrder = array();

//Sắp xếp giảm dần theo thứ tự hóa đơn:
function cpm($ord1, $ord2)
{
    return $ord1['OrderID'] < $ord2['OrderID'];
}
usort($allOrder, 'cpm');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css\bootstrap.css" />
    <script src="../css/jquery.min.js"></script>
</head>

<body id="body-content">
    <?php include('../menu.php') ?>
    <div class="container">
        <div>
            <h2>History</h2>
            <table class="table">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Date</td>
                        <td>Total</td>
                        <td>Detail</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 0;
                    foreach ($allOrder as $key => $value) {
                    ?>
                        <tr>
                            <td><?php echo ++$index ?></td>
                            <td><?php echo $value['Date'] ?> </td>
                            <td><?php echo number_format($value['Total']) ?></td>
                            <td>
                                <a href="detail.php?orderID=<?php echo $value['OrderID'] ?>">
                                    <span class="btn btn-info">Detail</span>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>