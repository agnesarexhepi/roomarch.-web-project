<?php
require_once __DIR__ . '/../Classes/Database.php';

class Contact extends Database {
    public function ruajMesazhin($emri, $email, $mesazhi) {
        $db = $this->getConnection();
        $sql = "INSERT INTO contacts (emri, email, mesazhi) VALUES (:emri, :email, :mesazhi)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':emri' => $emri,
            ':email' => $email,
            ':mesazhi' => $mesazhi
        ]);
    }

    public function merrMesazhet() {
        $db = $this->getConnection();
        $sql = "SELECT * FROM contacts ORDER BY id DESC";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function fshijMesazhin($id) {
        $db = $this->getConnection();
        $sql = "DELETE FROM contacts WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}