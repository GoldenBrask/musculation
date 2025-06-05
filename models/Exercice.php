<?php

class Exercice {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getAllByPartieCorps($partie_corps_id, $user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM exercices WHERE partie_corps_id = :partie_corps_id AND user_id = :user_id");
        $stmt->execute(['partie_corps_id' => $partie_corps_id, 'user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll($user_id) {
        $stmt = $this->pdo->prepare("SELECT exercices.id as id, exercices.nom as nomExos, parties_corps.nom as nomPartieCorps FROM exercices JOIN parties_corps ON exercices.partie_corps_id = parties_corps.id WHERE exercices.user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getById($id, $user_id) {
        $stmt = $this->pdo->prepare("SELECT exercices.id as id, exercices.nom as nomExos, parties_corps.nom as nomPartieCorps FROM exercices JOIN parties_corps ON exercices.partie_corps_id = parties_corps.id WHERE exercices.id = :id AND exercices.user_id = :user_id");
        $stmt->execute(['id' => $id, 'user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public function getAllPartiesCorps() {
        $stmt = $this->pdo->query("SELECT * FROM parties_corps");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nom, $partie_corps_id, $user_id) {
        $stmt = $this->pdo->prepare("INSERT INTO exercices (nom, partie_corps_id, user_id) VALUES (:nom, :partie_corps_id, :user_id)");
        $stmt->execute(['nom' => $nom, 'partie_corps_id' => $partie_corps_id, 'user_id' => $user_id]);
    }
}
?>
