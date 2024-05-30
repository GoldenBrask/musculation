<?php

class Exercice {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getAllByPartieCorps($partie_corps_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM exercices WHERE partie_corps_id = :partie_corps_id");
        $stmt->execute(['partie_corps_id' => $partie_corps_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM exercices");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    

    public function create($nom, $partie_corps_id) {
        $stmt = $this->pdo->prepare("INSERT INTO exercices (nom, partie_corps_id) VALUES (:nom, :partie_corps_id)");
        $stmt->execute(['nom' => $nom, 'partie_corps_id' => $partie_corps_id]);
    }
}
?>
