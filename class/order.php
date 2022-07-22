<?php
include_once('../connection.php');
class order
{
    /**
     * Hàm lấy toàn bộ order
     * - Tham số: integer cusID
     * - Trả về: array[orderID][prop of order]
     */
    public function getAllOrder($cusID)
    {
        $connection = DatabaseConnect::getVariable()->getConnection();
        $sql = 'SELECT  * FROM `order` WHERE CustomerID="' . $cusID . '"';
        $result = mysqli_query($connection, $sql);
        $list = array();
        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_array($result)) {
                $list[$data['OrderID']] = $data;
            }
            return $list;
        } else return null;
    }
    /**
     * Hàm lấy chi tiết orderDetail
     * - Tham số: integer orderID
     * - Trả về: array[vegetableID][prop of orderDetail]
     */
    public function getOrderDetail($orderid)
    {
        $connection = DatabaseConnect::getVariable()->getConnection();
        $sql = 'SELECT  * FROM `orderdetail` WHERE `OrderID`=' . $orderid;
        $result = mysqli_query($connection, $sql);
        $list = array();
        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_array($result)) {
                $list[$data['VegetableID']] = $data;
            }
            return $list;
        } else return null;
    }
    /**
     * Hàm thêm order, orderDetail
     * - Tham số order, detail
     */
    public function addOrder($order, $detail)
    {
        $connection = DatabaseConnect::getVariable()->getConnection();
        $sql = "SELECT COUNT(*) AS NUM FROM `order`";
        $result =  mysqli_query($connection, $sql);
        $data =  mysqli_fetch_array($result);
        $order['OrderID'] = $data['NUM'] + 1;
        $sql1 = "INSERT INTO `order`(OrderID, CustomerID, Date, Total, Note) VALUES(?,?,?,?,?)";
        $sql2 = "INSERT INTO `orderdetail`(OrderID, VegetableID, Quantity, Price) VALUES(?,?,?,?)";
        if ($stmt = mysqli_prepare($connection, $sql1)) {
            mysqli_stmt_bind_param($stmt, 'sssss', $orderID, $CusID, $Date, $Total, $Note);
            $orderID = $order['OrderID'];
            $CusID = $order['CustomerID'];
            $Date = $order['Date'];
            $Total = $order['Total'];
            $Note = $order['Note'];
            mysqli_stmt_execute($stmt);
        }
        if ($stmt = mysqli_prepare($connection, $sql2)) {
            mysqli_stmt_bind_param($stmt, 'ssss', $orderID, $VegeID, $Quantity, $Price);
            foreach ($detail as $key => $value) {
                $orderID = $order['OrderID'];
                $VegeID = $value['VegetableID'];
                $Quantity = $value['Quantity'];
                $Price = $value['Price'];
                mysqli_stmt_execute($stmt);
            }
        }
    }
}
?>