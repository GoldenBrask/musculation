<?php

class PartieCorps {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM parties_corps");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nom) {
        $stmt = $this->pdo->prepare("INSERT INTO parties_corps (nom) VALUES (:nom)");
        $stmt->execute(['nom' => $nom]);
    }
}
?>
