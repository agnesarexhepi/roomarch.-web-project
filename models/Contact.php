<?php
require_once __DIR__ . '/../Classes/Database.php';

class Contact extends Database {
    public function ruajMesazhin($emri, $email, $mesazhi) {
        $db = $this->connect();
        
        $sql = "INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)";
        
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':name' => $emri,
            ':email' => $email,
            ':message' => $mesazhi
        ]);
    }

    public function merrMesazhet() {
        $db = $this->connect();
        $sql = "SELECT * FROM contacts ORDER BY id DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fshijMesazhin($id) {
        $db = $this->connect(); 
        $sql = "DELETE FROM contacts WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>