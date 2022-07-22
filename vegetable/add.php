<?php
/**
 * Xử lí thêm sản phẩm
 */
include_once("../connection.php");
include_once("../class/vegetable.php");

if (isset($_REQUEST['submit-add'])) {
    /**
     * Hàm kiểm tra uploadfile
     */
    function uploadFile()
    {
        $file = $_FILES['img'];
        //Đường dẫn lưu file
        $fileDir = "../images/" . basename($file['name']);
        //Lấy phần mở rộng của file
        $fileType = pathinfo($fileDir, PATHINFO_EXTENSION);
        //Kích thước tối đa của file
        $fileMaxSize = 2 * 1024 * 1024;

        //Kiểm tra fileType:
        if ($fileType != 'jpg' && $fileType != 'jpeg' && $fileType != 'png') {
            return 0;
        }

        //Kiểm tra fileSize:
        if ($file['size'] > $fileMaxSize) {
            return 0;
        }

        //Kiểm tra fileError:
        if ($file['error']) {
            return 0;
        }

        //Kiểm tra tên file nếu trùng thì đổi tên:
        $d='_';
        while(file_exists($fileDir)){
            $d.='_';
            $fileDir="../images/".$d.basename($file['name']);
        }

        //Lưu file vào images
        if(move_uploaded_file($file['tmp_name'],$fileDir)){
            return $fileDir;
        }else return 0;
    }
    $bool = uploadFile();
    if(!$bool){
        echo '<script>alert("Thêm sản phẩm thất bại do ảnh không hợp lệ")</script>';
        echo '<script>window.location.href="new.php"</script>';
    }else{
        $bool = substr($bool,3,strlen($bool)-3);
        $newVege = array(
            'CategoryID'=> $_REQUEST['Category'],
            'VegetableName'=> $_REQUEST['VegetableName'],
            'Unit' => $_REQUEST['Unit'],
            'Amount' => $_REQUEST['Amount'],
            'Image' => $bool,
            'Price' => $_REQUEST['price'],
        );
        $vegetb = new vegetable();
        if($vegetb->add($newVege)){
            echo '<script>alert("Thêm sản phẩm thành thành công")</script>';
            echo '<script>window.location.href="new.php"</script>';
        }
    }
}
