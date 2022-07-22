<?php
    include('../class/category.php');
    /**
     * Xử lí request
     */
    $cates = new category();
    if (isset($_REQUEST['submit'])) {
        $cate['Name'] = $_REQUEST['name'];
        $cate['Description'] = $_REQUEST['des'];
        $cates->add($cate);
        echo 
        '<script>window.location.href = "http://localhost/marketonline/category/index.php" </script>';
    }
?>