<?php
if (session_id() === '') session_start();
include_once('../class/category.php');
$cate = new category();
$varCate = $cate->getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="..\css\bootstrap.css" />
    <title>Market Online</title>
    <script src="../css/jquery.min.js"></script>
    <style>
        .container {
            margin-left: 0%;
            padding-left: 0%;
        }

        .card {
            border: none;
            padding: 0.5em;
        }

        .btn {
            border-radius: 5px;
        }

        .card-img-top {
            width: 15em;
            height: 12em;
        }

        .price {
            height: 2em;
        }
    </style>
</head>

<body>
    <?php include('../menu.php') ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="form-group" id="Category">Category Name: </div>
                    <form>
                        <?php
                        foreach ($varCate as $key => $value) {
                        ?>
                            <div class="form-check form-group">
                                <input type="checkbox" class="form-check-input cate" value=<?php echo $value['CategoryID'] ?>>
                                <label class="form-check-label"><?php echo $value['Name'] ?></label>
                            </div>
                        <?php
                        }
                        ?>
                        <span class="btn btn-info" id="form-filter">Filter</span>
                    </form>
                </div>
            </div>
            <div class="col-md-9" id="Vegetable">
                <h3>Vegetable</h3>
                <div class="row" id="get-vegetable">
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    /**
     * Hàm Lấy dữ liệu từ vegetable.php
     */
    function getVegetable() {
        $.post('../class/vegetable.php', {
                'action': 'getAll'
            },
            function(data) {
                $('#get-vegetable').html(data);
            }
        )
    }

    /**
     * Hàm lọc sản phẩm:
     */
    function getFilter(cates) {
        $.post('../class/vegetable.php', {
            'action': 'getListByCateIDs',
            'cates': cates,
        }, function(data) {
            $('#get-vegetable').html(data);
        })
    }

    $(document).ready(function() {
        getVegetable();
        
        /**
         * Xử lí khi nhấn nút Filter: 
         */
        $("#form-filter").click(function() {
            var list = [];
            $('input.cate:checked').each(function() {
                list.push($(this).val());
            });
            if (list.length == 0) loadVegetable();
            else {
                var cate = JSON.stringify(list);
                getFilter(cate);
            }
        })
        /**
         * Xử lí khi nhấn nút buy:
         */
        $(document).on('click', '.btn-buy', function() {
            var vegetable = [];
            vegetable['img'] = $(this).parent().children('.img').children().attr('src');
            vegetable['name'] = $(this).parent().children('.info').children('.name').text();
            vegetable['price'] = $(this).parent().children('.info').children('.price').text();
            vegetable['id'] = $(this).parent().attr('id');
            vegetable['num'] = $(this).parent().children('.number').text();
            if (vegetable['num'] < 1) alert("Sản phẩm đã hết");
            else {
                $.post('../cart/index.php', {
                    'action': 'buy',
                    'img': vegetable['img'],
                    'name': vegetable['name'],
                    'price': vegetable['price'],
                    'id': vegetable['id'],
                }, function() {
                    window.location.href = 'http://localhost/marketonline/cart/index.php';
                });
            }
        })
    });
</script>

</html>