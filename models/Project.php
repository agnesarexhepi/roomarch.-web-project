<?php
class ProjectRepository {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    // merr të gjitha projektet
    public function getAllProjects() {
        $sql = "SELECT * FROM projects";
        $statement = $this->connection->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // shton një projekt 
    public function addProject($title, $description, $image, $author) {
        // prepared statements për siguri (pika 6)
        $sql = "INSERT INTO projects (title, description, image, author) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        
        return $stmt->execute([$title, $description, $image, $author]);
    }
}
?>