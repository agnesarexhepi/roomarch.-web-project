<?php
class Page {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function get($page_name) {
        $stmt = $this->pdo->prepare("SELECT content FROM pages WHERE page_name = ?");
        $stmt->execute([$page_name]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
