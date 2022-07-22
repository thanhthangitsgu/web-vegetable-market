 <?php
    include_once('../connection.php');
    class category
    {
        /**
         * a/Hàm lấy toàn bộ category
         * - Result: Array[VegetableID][Detail of category]
         */
        public function getAll()
        {
            $connection = DatabaseConnect::getVariable()->getConnection();
            $sql = 'SELECT * FROM category WHERE 1';
            $result = mysqli_query($connection, $sql);
            $list = array();
            if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_array($result)) {
                    $list[$data['CategoryID']] = $data;
                }
                return $list;
            } else return null;
        }

        /**
         * b/Hàm thêm mới category
         * - Tham số: array $cate
         */

        public function add($cate)
        {
            $connection = DatabaseConnect::getVariable()->getConnection();
            $_sql = "SELECT COUNT(*) AS NUM FROM `category`";
            $result =  mysqli_query($connection, $_sql);
            $data =  mysqli_fetch_array($result);
            $cate['CategoryID']=$data['NUM']+1;
            $sql = "INSERT INTO category (CategoryID,Name,Description) VALUES(?,?,?)";
            if ($stmt = mysqli_prepare($connection, $sql)) {
                mysqli_stmt_bind_param($stmt, 'sss', $id, $name, $des);
                $id = $cate['CategoryID'];
                $name = $cate['Name'];
                $des = $cate['Description'];
                mysqli_stmt_execute($stmt);
                return true;
            } else return false;
        }
    }
    ?>
