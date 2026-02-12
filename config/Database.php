<?php
class Database {
    private $host = "127.0.0.1";
    private $db_name = "db";           // DDEV database name
    private $username = "db";          // DDEV username
    private $password = "db";          // DDEV password
    private $port = "52624";           // DDEV port
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name,
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