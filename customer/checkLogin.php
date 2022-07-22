<?php
    include('..\connection.php');
    include('..\class\customer.php');
    if (session_id() === '') session_start();
/**
 * Hàm kiểm tra tài khoản
 * Trả về 0 nếu sai mật khẩu
 * Trả về -1 nếu không tồn tại
 * Trả về mảng chứa thông tin customer nếu đúng tài khoản
 */
function isCorrect($cusid, $password)
{
       $cus = new customer();
       $data = $cus->getByID($cusid);
       if($data==null) return -1;
       if($data['Password']!=$password) return 0;
       else return $data;
}
function alert($msg){
    echo "<script type='text/javascript'>alert('$msg');</script>";
    echo "<script>window.location.href = 
    'http://localhost/marketonline/customer/login.php'</script>";
}
if (isset($_POST['submit'])) {
    $cus = isCorrect($_POST['id'],$_POST['password']);
    if($cus==0){
        alert("Nhập sai password");
    }
    else if($cus==-1){
        alert("Không tìm thấy tài khoản");
    }else if($cus!=null){
        $_SESSION['CustomerID'] = $cus['CustomerID'];
        $_SESSION['Fullname'] = $cus['Fullname'];
        echo "<script>window.location.href = 
        'http://localhost/marketonline/vegetable/index.php'</script>";
    }
}
?>
