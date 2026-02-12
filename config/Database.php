<?php
class Database {
    private $host = "localhost";
    private $db_name = "rest_api_db";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo json_encode([
                'error' => true,
                'message' => 'Connection error: ' . $exception->getMessage()
            ]);
        }
        
        return $this->conn;
    }
}
?>
