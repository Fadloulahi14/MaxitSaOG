<?php

namespace App\Repository;
use App\core\Database;
use App\core\App;
use PDO;

class TransactionRepository {
    private PDO $pdo;
    
    public function __construct() {
        $this->pdo = App::getDependency('database');
    }

    public function findByCompteId($compteId): array {
        $sql = "SELECT * FROM transaction WHERE id_compte = :compte_id ORDER BY date DESC LIMIT 10";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':compte_id', $compteId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByCompteIdWithFilters($compteId, $date = null, $type = null): array {
        try {
            $sql = "SELECT * FROM transaction WHERE id_compte = :compte_id";
            $params = ['compte_id' => $compteId];
            
            if ($date) {
                $sql .= " AND DATE(date) = :date";
                $params['date'] = $date;
            }
            
            if ($type) {
                $sql .= " AND type = :type";
                $params['type'] = $type;
            }
            
            $sql .= " ORDER BY date DESC";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (\PDOException $e) {
            error_log("Erreur findByCompteIdWithFilters: " . $e->getMessage());
            return [];
        }
    }

    public function createTransaction($compteId, $montant, $type, $numCompteDepot = null, $numCompteDestinataire = null): ?int {
        try {
            $sql = "INSERT INTO transaction (id_compte, montant, type, numcomptedepot, numcomptedestinataire, date) 
                   VALUES (:id_compte, :montant, :type, :numcomptedepot, :numcomptedestinataire, NOW())";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_compte', $compteId, PDO::PARAM_INT);
            $stmt->bindParam(':montant', $montant);
            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->bindParam(':numcomptedepot', $numCompteDepot, PDO::PARAM_INT);
            $stmt->bindParam(':numcomptedestinataire', $numCompteDestinataire, PDO::PARAM_INT);
            
            $result = $stmt->execute();
            
            if (!$result) {
                throw new \RuntimeException("Échec de l'exécution de la requête");
            }
            
            return $this->pdo->lastInsertId();
            
        } catch (\PDOException $e) {
            error_log("Erreur SQL createTransaction: " . $e->getMessage());
            throw new \RuntimeException("Erreur lors de la création de la transaction: " . $e->getMessage());
        }
    }
}