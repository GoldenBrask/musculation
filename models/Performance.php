<?php

class Performance {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getByDate($date, $user_id) {
        $stmt = $this->pdo->prepare("SELECT performances.id as idPerf, performances.date as date, performances.poids as poids, performances.series as series, performances.repetitions as repetitions, exercices.nom as nomExos FROM performances JOIN exercices ON performances.exercice_id = exercices.id WHERE performances.date = :date AND performances.user_id = :user_id");
        $stmt->execute(['date' => $date, 'user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll($user_id) {
        $stmt = $this->pdo->prepare(
            "SELECT p.id AS idPerf, p.date, p.poids, p.series, p.repetitions, e.nom AS nomExos
             FROM performances p
             JOIN exercices e ON p.exercice_id = e.id
             WHERE p.user_id = :user_id
             ORDER BY p.date DESC"
        );
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastByExerciceId($exercice_id, $user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM performances WHERE exercice_id = :exercice_id AND user_id = :user_id ORDER BY date DESC LIMIT 1");
        $stmt->execute(['exercice_id' => $exercice_id, 'user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAllByExerciceId($exercice_id, $user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM performances WHERE exercice_id = :exercice_id AND user_id = :user_id ORDER BY date DESC");
        $stmt->execute(['exercice_id' => $exercice_id, 'user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


    public function create($date, $exercice_id, $poids, $series, $repetitions, $user_id) {
        $stmt = $this->pdo->prepare("INSERT INTO performances (date, exercice_id, poids, series, repetitions, user_id) VALUES (:date, :exercice_id, :poids, :series, :repetitions, :user_id)");
        $stmt->execute([
            'date' => $date,
            'exercice_id' => $exercice_id,
            'poids' => $poids,
            'series' => $series,
            'repetitions' => $repetitions,
            'user_id' => $user_id
        ]);
    }


    public function getAllbyPartieCorps($partie_corps_id, $user_id) {
        $stmt = $this->pdo->prepare("
            SELECT p.id AS idPerf, p.date, p.poids, p.series, p.repetitions, e.nom AS nomExos
            FROM performances p
            JOIN exercices e ON p.exercice_id = e.id
            WHERE e.partie_corps_id = :partie_corps_id AND p.user_id = :user_id
            ORDER BY p.date DESC
        ");
        $stmt->execute(['partie_corps_id' => $partie_corps_id, 'user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
