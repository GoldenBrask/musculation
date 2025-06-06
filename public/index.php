<?php
require_once '../config/config.php';
require_once '../models/Database.php';
require_once '../lib/AltoRouter.php';

session_start();

$router = new AltoRouter();

$routes = require '../config/routes.php';
foreach ($routes as $route) {
    list($method, $path, $target) = $route;
    $router->map($method, $path, $target);
}

$match = $router->match();

if ($match && !in_array($match['target'], ['UserController#login', 'UserController#register']) && !isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

if ($match) {
    list($controllerName, $action) = explode('#', $match['target']);
    require_once '../controllers/' . $controllerName . '.php';
    $controller = new $controllerName();
    call_user_func_array([$controller, $action], $match['params']);
} else {
    header('HTTP/1.1 404 Not Found');
    echo 'Page not found';
}
?>
