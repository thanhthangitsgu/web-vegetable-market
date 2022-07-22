<?php
//Class kết nối database:
class DatabaseConnect{
    private $connection;
    private static $database;
    public static function getVariable(){
        if(!self::$database){
            self::$database = new DatabaseConnect();
        }
        return self::$database;
    }
    public function getConnection(){
        if(!$this->connection){
            try{
                $this->connection = mysqli_connect('localhost','root','','market');
            }catch(Exception $e){
                echo "Không nết nối được CSDL".$e->getCode();
                exit;
            }
        }
        return $this->connection;
    }
}
?>