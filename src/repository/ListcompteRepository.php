<?php

namespace App\Repository;
use App\core\Database;
use App\core\App;
use PDO;

class ListcompteRepository {
    private PDO $pdo;
    
    public function __construct() {
        $this->pdo = App::getDependency('database');
    }

    public function getCompteSecondairesByClient($clientId): array {
        try {
            $sql = "SELECT id, numerotelephone, solde, estprincipale 
                   FROM compte 
                   WHERE id_client = :clientid AND estprincipale = false 
                   ORDER BY id DESC";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':clientid', $clientId, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (\PDOException $e) {
            error_log("Erreur getCompteSecondairesByClient: " . $e->getMessage());
            return [];
        }
    }

    public function countCompteSecondairesByClient($clientId): int {
        try {
            $sql = "SELECT COUNT(*) FROM compte WHERE id_client = :clientid AND estprincipale = false";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':clientid', $clientId, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchColumn();
            
        } catch (\PDOException $e) {
            error_log("Erreur countCompteSecondairesByClient: " . $e->getMessage());
            return 0;
        }
    }

    public function getTotalSoldeCompteSecondaires($clientId): float {
        try {
            $sql = "SELECT SUM(solde) FROM compte WHERE id_client = :clientid AND estprincipale = false";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':clientid', $clientId, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetchColumn();
            return $result ? (float)$result : 0.0;
            
        } catch (\PDOException $e) {
            error_log("Erreur getTotalSoldeCompteSecondaires: " . $e->getMessage());
            return 0.0;
        }
    }

    public function changerComptePrincipal($clientId, $nouveauComptePrincipalId): bool {
        try {
            $this->pdo->beginTransaction();
            
            
            $sql1 = "UPDATE compte SET estprincipale = false WHERE id_client = :clientid";
            $stmt1 = $this->pdo->prepare($sql1);
            $stmt1->bindParam(':clientid', $clientId, PDO::PARAM_INT);
            $stmt1->execute();
            
            
            $sql2 = "UPDATE compte SET estprincipale = true WHERE id = :compteid AND id_client = :clientid";
            $stmt2 = $this->pdo->prepare($sql2);
            $stmt2->bindParam(':compteid', $nouveauComptePrincipalId, PDO::PARAM_INT);
            $stmt2->bindParam(':clientid', $clientId, PDO::PARAM_INT);
            $stmt2->execute();
            
             $this->pdo->commit();

         
            return true;
            
        } catch (\PDOException $e) {
            $this->pdo->rollback();
            error_log("Erreur changerComptePrincipal: " . $e->getMessage());
            return false;
        }
    }

    public function getCompteById($compteId): ?array {
        try {
            $sql = "SELECT id, numerotelephone, solde, estprincipale, id_client FROM compte WHERE id = :compteid";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':compteid', $compteId, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
            
        } catch (\PDOException $e) {
            error_log("Erreur getCompteById: " . $e->getMessage());
            return null;
        }
    }
}