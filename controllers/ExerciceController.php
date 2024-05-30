<?php

require_once __DIR__ . '/../models/Exercice.php';
require_once __DIR__ . '/../models/PartieCorps.php';
require_once __DIR__ . '/../models/Performance.php';

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

    public function show($id) {
        $exercice = new Exercice();
        $details = $exercice->getById($id);
        $performance = new Performance();
        $performances = $performance->getAllByExerciceId($id);
    
        require_once __DIR__ . '/../views/exercice_details.php';
    }
    
}
?>
