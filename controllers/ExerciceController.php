<?php

require_once __DIR__ . '/../models/Exercice.php';
require_once __DIR__ . '/../models/PartieCorps.php';

class ExerciceController {
    public function index() {
        $partieCorps = new PartieCorps();
        $parties = $partieCorps->getAll();
        $exercice = new Exercice();
        $exercices = $exercice->getAll();

        require_once __DIR__ . '/../views/exercices.php';
    }

    public function create() {
        if ($_POST) {
            $exercice = new Exercice();
            $exercice->create($_POST['nom'], $_POST['partie_corps_id']);
            header('Location: /exercices');
        }
    }
}
?>
