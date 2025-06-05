<?php

require_once __DIR__ . '/../models/Performance.php';

class HomeController {
    public function index() {
        $performanceModel = new Performance();
        $performances = $performanceModel->getAll($_SESSION['user_id']);

        require_once __DIR__ . '/../views/home.php';
    }
}
?>
