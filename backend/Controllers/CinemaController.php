<?php
require_once 'Models/Movie.php';
require_once 'Models/Room.php';
require_once 'Models/Showtime.php';

class CinemaController {
    private $movieModel;
    private $roomModel;
    private $showtimeModel;

    public function __construct($pdo) {
        $this->movieModel = new Movie($pdo);
        $this->roomModel = new Room($pdo);
        $this->showtimeModel = new Showtime($pdo);
    }

    public function index() {
        $movies = $this->movieModel->getAll();
        $rooms = $this->roomModel->getAll();
        $showtimes = $this->showtimeModel->getAll();
        require 'services/dashboard.php';
    }

    public function addMovie($data) {
        if (!empty($data['title']) && !empty($data['duration'])) {
            $this->movieModel->create($data['title'], $data['duration'], $data['description'] ?? '');
        }
        header('Location: index.php');
    }

    public function deleteMovie($id) {
        $this->movieModel->delete($id);
        header('Location: index.php');
    }

    
    public function getMoviesJson() {
        header('Content-Type: application/json');
        echo json_encode($this->movieModel->getAll());
    }
}