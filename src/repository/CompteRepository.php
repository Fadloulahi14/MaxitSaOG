<?php
namespace App\Repository;

use App\core\Database;
use PDO;
use App\core\App;

class CompteRepository {
    private PDO $pdo;
    
    public function __construct() {
        $this->pdo = App::getDependency('database');
    }
    
    public function telephoneExists($telephone): bool {
        try {
            $sql = "SELECT COUNT(*) FROM compte WHERE numerotelephone = :telephone";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->fetchColumn() > 0;
        } catch (\PDOException $e) {
            throw new \RuntimeException("Erreur de vérification téléphone: " . $e->getMessage());
        }
    }
    
    public function createCompteSecondaire($clientId, $telephone, $solde = 0): ?int {
        try {
            $sql = "INSERT INTO compte (numerotelephone, solde, estprincipale, id_client) 
                   VALUES (:telephone, :solde, false, :clientid)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
            $stmt->bindParam(':solde', $solde, PDO::PARAM_STR);
            $stmt->bindParam(':clientid', $clientId, PDO::PARAM_INT);
            $stmt->execute();
            
            return $this->pdo->lastInsertId();
            
        } catch (\PDOException $e) {
            throw new \RuntimeException("Erreur lors de la création du compte: " . $e->getMessage());
        }
    }
    
    public function updateSolde($compteId, $nouveauSolde): bool {
        try {
            $sql = "UPDATE compte SET solde = :solde WHERE id = :compteid";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':solde', $nouveauSolde, PDO::PARAM_STR);
            $stmt->bindParam(':compteid', $compteId, PDO::PARAM_INT);
            
            return $stmt->execute();
            
        } catch (\PDOException $e) {
            throw new \RuntimeException("Erreur lors de la mise à jour du solde: " . $e->getMessage());
        }
    }
    
    public function getComptesByClient($clientId): array {
        try {
            $sql = "SELECT id, numerotelephone, solde, estprincipale FROM compte WHERE id_client = :clientid ORDER BY estprincipale DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':clientid', $clientId, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (\PDOException $e) {
            throw new \RuntimeException("Erreur lors de la récupération des comptes: " . $e->getMessage());
        }
    }
}