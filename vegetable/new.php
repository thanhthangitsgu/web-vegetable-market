<!DOCTYPE html>
<html lang="en">
<?php
include_once('../class/category.php');
include_once('../class/vegetable.php');
$cate = new category();
$vege = new vegetable();
$varCate = $cate->getAll();
$varVege = $vege->getAll();
$listUnit = array();
if (!isset($_SESSION['CustomerID'])) {
    echo '<script> alert("Bạn phải đăng nhập mới sử dụng được chức năng này") </script>';
    echo "<script>window.location.href = 'http://localhost/marketonline/customer/login.php'</script>";
}
foreach ($varVege as $value) {
    $listUnit[$value['Unit']] = 1;
}
?>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css\bootstrap.css" />
    <script src="../css/jquery.min.js"></script>
</head>

<body>
    <?php include('../menu.php') ?>
    <div class="container">
        <div>
            <h2>Add Vegetable</h2>
        </div>
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <label for="Name">Vegetable Name:</label>
                        <input type="text" name="VegetableName" class="form-control" required id="name">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Unit:</label>
                                <select class="form-control" name="Unit">
                                    <?php
                                    foreach ($listUnit as $key => $value) {
                                    ?>
                                        <option value=<?php echo $key ?>><?php echo $key ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="Amount">Amount:</label>
                            <input type="text" name="Amount" class="form-control" required id="amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img">Image:</label>
                        <input type="file" class="form-control" name="img" id="upload-file" accept=".jpg, .png">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Category Name:</label>
                        <select class="form-control" name="Category">
                            <?php
                            foreach ($varCate as $value) {
                            ?>
                                <option value=<?php echo $value['CategoryID'] ?>><?php echo $value['Name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" name="price" required id="price">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" id="submit-add-vege" class="btn btn-info" name="submit-add">
            </div>
        </form>
    </div>
</body>
<script>
    function validateNumber(value) {
        return (!isNaN(Number(value)) && /^\d+$/.test(value));
    }
    $(document).ready(function() {
        $('#upload-file').change(function(event) {
            const files = event.target.files;
            const file = files[files.length - 1];
            var type = file.type ? file.type : 'Nope';
            var size = file.size;
            if (size > 2 * 1024 * 1024) alert("Kích thước hình vượt quá 2MB, vui lòng chọn lại");
            else if (type != 'image/jpg' && type != 'image/png' && type != 'image/jpeg')
                alert("Vui lòng chọn tệp jpg/png");
        });
        $('#submit-add-vege').click(function() {
            var flag = 0;
            if (!validateNumber($('#price').val())) {
                flag = 1;
                $('#price').val("");
            }
            if (!validateNumber($('#amount').val())) {
                $('#amount').val("");
                flag = 1;
            }
            if (flag) alert("Giá hoặc số lượng chưa hợp lệ");
        })
    })
</script>

</html>