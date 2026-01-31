<?php
class Database {
    private $host = "localhost";
    private $db = "roomarch_db";
    private $user = "root";

    private $pass = "";

    public function connect() {
        try {
            return new PDO(
                "mysql:host=$this->host;dbname=$this->db;charset=utf8",
                $this->user,
                $this->pass
            );
        } catch (PDOException $e) {
            die("Database error");
        }
    }
}
$db = new Database();
$conn = $db->connect();
if ($conn) {
    echo "Database connection successful.";
}
?>