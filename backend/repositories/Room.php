<?php
class Room {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        return $this->pdo->query("SELECT * FROM rooms")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM rooms WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $capacity) {
        $stmt = $this->pdo->prepare("INSERT INTO rooms (name, capacity) VALUES (?, ?)");
        return $stmt->execute([htmlspecialchars($name), (int)$capacity]);
    }

    public function update($id, $name, $capacity) {
        $stmt = $this->pdo->prepare("UPDATE rooms SET name = ?, capacity = ? WHERE id = ?");
        return $stmt->execute([htmlspecialchars($name), (int)$capacity, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM rooms WHERE id = ?");
        return $stmt->execute([$id]);
    }
}