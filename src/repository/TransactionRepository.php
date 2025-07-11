<?php

namespace App\Repository;
use App\core\Database;
use PDO;

class TransactionRepository {
    private PDO $pdo;
    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function findByCompteId($compteId): array {
        $sql = "SELECT * FROM Transaction WHERE id_compte = :compteId ORDER BY date DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':compteId', $compteId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}