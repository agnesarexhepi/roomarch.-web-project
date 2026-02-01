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
}
?>