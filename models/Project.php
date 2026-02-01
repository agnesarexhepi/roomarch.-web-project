<?php
class ProjectRepository {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    // merr të gjitha projektet
    public function getAllProjects() {
        $sql = "SELECT * FROM projects ORDER BY created_at DESC";
        $statement = $this->connection->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // shton një projekt 
   public function addProject($title, $location, $image, $description, $created_by) {
        // Përshtatja me kolonat: title, location, image, description, created_by
        $sql = "INSERT INTO projects (title, location, image, description, created_by) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$title, $location, $image, $description, $created_by]);
    }

    // --- METODAT E REJA PËR DASHBOARD ---

    // Merr  nje projekt
    public function getProjectById($id) {
        $sql = "SELECT * FROM projects WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Fshin 
    public function deleteProject($id) {
        $sql = "DELETE FROM projects WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>