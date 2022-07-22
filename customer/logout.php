<?php
if (session_id() === '') session_start();
if(isset($_SESSION['CustomerID'])){
    //Xóa session:
    session_destroy();
    //Trở về trang chính index.php
    echo "<script>window.location.href = 'http://localhost/marketonline/index.php'</script>";
}
?>