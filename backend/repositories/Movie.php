<?php
class Movie {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        return $this->pdo->query("SELECT * FROM movies")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM movies WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $duration, $desc) {
        $stmt = $this->pdo->prepare("INSERT INTO movies (title, duration, description) VALUES (?, ?, ?)");
        return $stmt->execute([htmlspecialchars($title), (int)$duration, htmlspecialchars($desc)]);
    }

    public function update($id, $title, $duration, $desc) {
        $stmt = $this->pdo->prepare("UPDATE movies SET title = ?, duration = ?, description = ? WHERE id = ?");
        return $stmt->execute([htmlspecialchars($title), (int)$duration, htmlspecialchars($desc), $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM movies WHERE id = ?");
        return $stmt->execute([$id]);
    }
}