<?php

require_once '../config/config.php';
require_once '../models/Database.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ('/' === $uri) {
    require '../controllers/HomeController.php';
    $controller = new HomeController();
    $controller->index();
} elseif ('/exercices' === $uri) {
    require '../controllers/ExerciceController.php';
    $controller = new ExerciceController();
    $controller->index();
} elseif ('/exercice/create' === $uri && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../controllers/ExerciceController.php';
    $controller = new ExerciceController();
    $controller->create();
} elseif ('/performances' === $uri) {
    require '../controllers/PerformanceController.php';
    $controller = new PerformanceController();
    $controller->index();
} elseif ('/performance/create' === $uri && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../controllers/PerformanceController.php';
    $controller = new PerformanceController();
    $controller->create();
} else {
    header('HTTP/1.1 404 Not Found');
    echo $uri;
    echo 'Page not found';
}
?>
