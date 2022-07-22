<?php
include ('../connection.php');
include ('../class/customer.php');
function addCus(){
    $custom = new customer();
    if(isset($_REQUEST['submit'])){
        $cus= array(
            'Password' => $_REQUEST['password'],
            'Fullname' => $_REQUEST['fullname'],
            'Address' => $_REQUEST['address'],
            'City' => $_REQUEST['city'],
        );
        return $custom->add($cus);
    }
    return false;
}
if(addCus()){
    echo "<script type='text/javascript'>alert('Thêm tài khoản thành công');</script>";
}
else{
    echo "<script type='text/javascript'>alert('Thêm tài khoản thất bại');</script>";
}
echo "<script>window.location.href = 'http://localhost/marketonline/customer/register.php'</script>";
?>
