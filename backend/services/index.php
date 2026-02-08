<?php
// Configuration & Connexion
try {
    $pdo = new PDO('mysql:host=localhost;dbname=cinema_management;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

require_once 'Controllers/CinemaController.php';
$controller = new CinemaController($pdo);


$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'addMovie':
        $controller->addMovie($_POST);
        break;
    case 'deleteMovie':
        $controller->deleteMovie($_GET['id']);
        break;
    case 'api_movies':
        $controller->getMoviesJson();
        break;
    default:
        $controller->index();
        break;
}