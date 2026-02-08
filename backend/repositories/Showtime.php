<?php
class Showtime {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

   
    public function getAll() {
        $sql = "SELECT showtimes.*, movies.title as movie_title, rooms.name as room_name 
                FROM showtimes 
                JOIN movies ON showtimes.movie_id = movies.id 
                JOIN rooms ON showtimes.room_id = rooms.id";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM showtimes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($movie_id, $room_id, $start_time) {
        $stmt = $this->pdo->prepare("INSERT INTO showtimes (movie_id, room_id, start_time) VALUES (?, ?, ?)");
        return $stmt->execute([(int)$movie_id, (int)$room_id, $start_time]);
    }

    public function update($id, $movie_id, $room_id, $start_time) {
        $stmt = $this->pdo->prepare("UPDATE showtimes SET movie_id = ?, room_id = ?, start_time = ? WHERE id = ?");
        return $stmt->execute([(int)$movie_id, (int)$room_id, $start_time, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM showtimes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}