<?php 
class Database{
    // Localhost
    private $host = "localhost";
    private $db_name = "tmt_test";
    private $username = "root";
    private $password = "";
    public $conn;

    // private $host = "sql210.infinityfree.com";
    // private $db_name = "if0_34599066_tmt_test";
    // private $username = "if0_34599066";
    // private $password = "k7IVfFoUMMwa";
    // public $conn;

 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}

?>
