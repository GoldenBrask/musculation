<?php

require_once __DIR__ . '/../models/Performance.php';
require_once __DIR__ . '/../models/Exercice.php';

class PerformanceController {
    public function index() {
        $date = $_GET['date'] ?? date('Y-m-d');
        $performance = new Performance();
        $performances = $performance->getByDate($date);
        $exercice = new Exercice();
        $exercices = $exercice->getAll();
        $parties = $exercice->getAllPartiesCorps();
        


        require_once __DIR__ . '/../views/performances.php';
    }

    public function create() {
        if ($_POST) {
            $performance = new Performance();
            $performance->create($_POST['date'], $_POST['exercice_id'], $_POST['poids'], $_POST['series'], $_POST['repetitions']);
            header('Location: /performances?date=' . $_POST['date']);
        }
    }

    public function getLastPerformance() {
        if (!isset($_GET['exercice_id'])) {
            echo json_encode(['success' => false, 'message' => 'Exercice ID is required']);
            return;
        }
    
        $exercice_id = $_GET['exercice_id'];
        $performance = new Performance();
        $lastPerformance = $performance->getLastByExerciceId($exercice_id);
    
        if ($lastPerformance) {
            echo json_encode(['success' => true, 'poids' => $lastPerformance['poids'], 'series' => $lastPerformance['series'], 'repetitions' => $lastPerformance['repetitions']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No performance data found']);
        }
    }

    public function data() {
        if (!isset($_GET['exercice_id'])) {
            echo json_encode(['success' => false, 'message' => 'Exercice ID is required']);
            return;
        }
    
        $exercice_id = $_GET['exercice_id'];
        $performance = new Performance();
        $lastPerformance = $performance->getLastByExerciceId($exercice_id);
    
        if ($lastPerformance) {
            echo json_encode(['success' => true, 'poids' => $lastPerformance['poids'], 'series' => $lastPerformance['series'], 'repetitions' => $lastPerformance['repetitions']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No performance data found']);
        }
    }

    public function filter() {
        if (!isset($_POST['partie_corps_id'])) {
            echo json_encode(['success' => false, 'message' => 'Partie corps ID is required']);
            return;
        }

        $partie_corps_id = $_POST['partie_corps_id'];
        $date = $_POST['date'] ?? date('Y-m-d');

        $performance = new Performance();
        if ($partie_corps_id == 0) {
            $filteredPerformances = $performance->getByDate($date);
        } else {
            $filteredPerformances = $performance->getAllbyPartieCorps($partie_corps_id);
        }
    
        if ($filteredPerformances) {
            echo json_encode(['success' => true, 'performances' => $filteredPerformances]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No performances found']);
        }
    }
    
    
    
    
}
?>
