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
        $stmt = $this->pdo->query("SELECT exercices.id as id, exercices.nom as nomExos, parties_corps.nom as nomPartieCorps FROM exercices JOIN parties_corps ON exercices.partie_corps_id = parties_corps.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM exercices WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllPartiesCorps() {
        $stmt = $this->pdo->query("SELECT * FROM parties_corps");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nom, $partie_corps_id) {
        $stmt = $this->pdo->prepare("INSERT INTO exercices (nom, partie_corps_id) VALUES (:nom, :partie_corps_id)");
        $stmt->execute(['nom' => $nom, 'partie_corps_id' => $partie_corps_id]);
    }
}
?>
