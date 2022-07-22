<?php
include_once('../connection.php');
class customer{
    /**
     * Lấy customer theo ID:
     * - Tham số cusID
     * - Trả về array[prop of Customer]
     */
    public function getByID($cusid){
        $connection = DatabaseConnect::getVariable()->getConnection();
        $sql = 'SELECT  * FROM customers WHERE CustomerID='.$cusid;
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0){
            while($data = mysqli_fetch_array($result)){
                return $data;
            }
        }else return null;
    }
    /**
     * Hàm thêm customer:
     * - Tham số: $cus
     */

    public function add($cus){
        $connection = DatabaseConnect::getVariable()->getConnection();
        $_sql = "SELECT COUNT(*) AS NUM FROM customers WHERE 1";
        $result =  mysqli_query($connection,$_sql);
        $data =  mysqli_fetch_array($result);
        $cus['CustomerID'] = $data['NUM']+1;
        $sql = "INSERT INTO customers (CustomerID,Password,Fullname,Address,City) VALUES(?,?,?,?,?)";
        if($stmt=mysqli_prepare($connection,$sql)){
            mysqli_stmt_bind_param($stmt,'sssss',$id,$password,$fullname,$address,$city);
            $id = $cus['CustomerID'];
            $password = $cus['Password'];
            $fullname = $cus['Fullname'];
            $address = $cus['Address'];
            $city = $cus['City'];
            mysqli_stmt_execute($stmt);
            return true;
        }
        else return false;
    }
}
