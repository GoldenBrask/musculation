<?php

class Performance {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getByDate($date) {
        $stmt = $this->pdo->prepare("SELECT * FROM performances WHERE date = :date");
        $stmt->execute(['date' => $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastByExerciceId($exercice_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM performances WHERE exercice_id = :exercice_id ORDER BY date DESC LIMIT 1");
        $stmt->execute(['exercice_id' => $exercice_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public function create($date, $exercice_id, $poids, $series, $repetitions) {
        $stmt = $this->pdo->prepare("INSERT INTO performances (date, exercice_id, poids, series, repetitions) VALUES (:date, :exercice_id, :poids, :series, :repetitions)");
        $stmt->execute([
            'date' => $date,
            'exercice_id' => $exercice_id,
            'poids' => $poids,
            'series' => $series,
            'repetitions' => $repetitions
        ]);
    }
}
?>
