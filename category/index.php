<?php
include_once('../class/category.php');
if(!isset($_SESSION['CustomerID'])){
    echo '<script> alert("Bạn phải đăng nhập mới sử dụng được chức năng này") </script>';
    echo "<script>window.location.href = 'http://localhost/marketonline/customer/login.php'</script>";
}
$cate = new category();
$data = $cate->getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css\bootstrap.css" />
    <script src="../css/jquery.min.js"></script>
</head>
<body>
    <?php include('../menu.php') ?>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <br><br>
                <form method="post" action="add.php">
                    <div class="form-group">
                        <div>Name: </div>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <div>Description: </div>
                        <input type="text" class="form-control" name="des">
                    </div>
                    <input type="submit" name="submit" value="Add" class="btn btn-info">
                </form>
            </div>
            <div class="col-8">
                <br>
                <h2>Category</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Name</td>
                            <td>Desciption</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index=0;
                        foreach ($data as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo ++$index?></td>
                            <td><?php echo $value['Name']?></td>
                            <td><?php echo $value['Description']?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>