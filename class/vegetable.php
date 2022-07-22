<?php
include_once('../connection.php');
class vegetable
{
    /**
     * Hàm lấy toàn bộ sản phẩm
     * - Trả về: Array[VegetableID][Detail of product]
     */
    public function getAll()
    {
        $connection = DatabaseConnect::getVariable()->getConnection();
        $sql = 'SELECT * FROM vegetable WHERE 1';
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
     * Hàm lấy danh sách sản phẩm theo CategoryID
     * - Tham số: Integer CategoryID
     * - Trả về: Array[VegetableID][Detail of product]
     */
    public function getListByCateID($cateid)
    {
        $connection = DatabaseConnect::getVariable()->getConnection();
        $sql = "SELECT * FROM vegetable WHERE CategoryID= " . $cateid;
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
     * Hàm lấy danh sách sản phẩm theo nhiều CategoryID
     * - Tham số: Array[CategoryID]
     * - Trả về: Array[CategoryID][Result of method getListByCateID($cateid)]
     */
    public function getListByCateIDs($cateids)
    {
        $vege = new vegetable();
        $list = array();
        foreach ($cateids as $value) {
            $list[$value] = $vege->getListByCateID($value);
        }
        return $list;
    }

    /**
     * Hàm lấy sản phẩm theo ID:
     * - Tham số: integer vegetableID
     * - Trả về: Array[prop]
     */
    public function getByID($vegetableID)
    {
        $connection = DatabaseConnect::getVariable()->getConnection();
        $sql = "SELECT * FROM `vegetable` WHERE VegetableID= " . $vegetableID;
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_array($result)) {
                return $data;
            }
        } else return null;
    }
    /**
     * Hàm cập nhật số lượng sản phẩm
     * - Tham số: integer vegetableID, integer num
     */
    public function updateByID($vegetableID, $num)
    {
        $connection = DatabaseConnect::getVariable()->getConnection();
        $sql = "UPDATE `vegetable` SET `Amount` ='" . $num . "' WHERE  VegetableID =" . $vegetableID;
        return mysqli_query($connection, $sql);
    }

    /**
     * Hàm thêm sản phẩm
     * - Tham số: array vege
     */
    public function add($vege)
    {
        $connection = DatabaseConnect::getVariable()->getConnection();
        $_sql = "SELECT COUNT(*) AS NUM FROM `vegetable` WHERE 1";
        $result =  mysqli_query($connection, $_sql);
        $data =  mysqli_fetch_array($result);
        $vege['VegetableID'] = $data['NUM'] + 1;
        $sql = "INSERT INTO `vegetable`(VegetableID,CategoryID,VegetableName,Unit,Amount,Image,Price) VALUES(?,?,?,?,?,?,?)";
        if ($stmt = mysqli_prepare($connection, $sql)) {
            mysqli_stmt_bind_param($stmt, 'sssssss', $vegeID, $cateID, $vegeName, $unit, $amount, $image, $price);
            $vegeID = $vege['VegetableID'];
            $cateID = $vege['CategoryID'];
            $vegeName = $vege['VegetableName'];
            $unit = $vege['Unit'];
            $amount = $vege['Amount'];
            $image = $vege['Image'];
            $price = $vege['Price'];
            mysqli_stmt_execute($stmt);
            return true;
        } else return false;
    }
}
$vege = new vegetable();
/**
 * Xử lí request
 */
if (isset($_REQUEST['action'])) {
   //Hàm tạo mã HTML:
    function createCardVege($id,$name,$img,$price,$number){
        return 
        '<div class="col-xl-4">
             <div class="card" id="'.$id.'">
                <div class="form-group img"><img src="../'.$img.'" class="card-img-top"></div>
                <div class="form-group info">
                    <label class="name">'.$name.'</label>
                    <span style=" color: white" class="btn-warning btn-sm disabled price"><b>'.number_format($price).'</b></span>
                 </div>
                <div class="number" hidden>'.$number.'</div>
                <div class="btn-buy"><span class="btn btn-danger">Buy</span></div>
            </div>
        </div>';
    }
    switch ($_REQUEST['action']) {
        case 'getAll':
            $varVege = $vege->getAll();
            $htmlCode="";
            foreach($varVege as $key => $value){
                $htmlCode.=createCardVege($value['VegetableID'],$value['VegetableName'],$value['Image'],$value['Price'],$value['Amount']);
            }
            echo $htmlCode;
            break;
        case 'getListByCateIDs':
            $listVege = json_decode($_REQUEST['cates']);
            $htmlCode = "";
            $varVege = $vege ->getListByCateIDs($listVege);
            foreach($varVege as $index => $arr){
                if($arr==null) $arr=array();
                foreach($arr as $key => $value){
                    $htmlCode.= createCardVege($value['VegetableID'],$value['VegetableName'],$value['Image'],$value['Price'],$value['Amount']);
                }
            }
            echo $htmlCode;
            break;
    };
}
