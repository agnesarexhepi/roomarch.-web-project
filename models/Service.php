<?php 
class Service {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllServices() {
        $sql = "SELECT * FROM services";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addService($title, $description, $image, $color, $price, $plan, $admin_id) {
        $sql = "INSERT INTO services (title, description, image_path, block_color, price, plan_name, added_by) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$title, $description, $image, $color, $price, $plan, $admin_id]);
    }

    public function getTotalServices() {
        $sql = "SELECT COUNT(*) as total FROM services";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}