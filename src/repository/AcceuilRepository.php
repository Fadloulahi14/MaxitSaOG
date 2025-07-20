<?php
namespace App\Repository;
use App\core\Database;
use PDO;

class AcceuilRepository{
    private PDO $pdo;
    public function __construct(){
        $this ->pdo = Database::getInstance();

    }

   public function findAll(): array {
        $sql = "SELECT * FROM commandes";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
// public function findByClientId(int $clientId): array {
    
//     $sql = "SELECT * FROM commandes WHERE client_id = :client_id";
//     $stmt = $this->pdo->prepare($sql);
//     $stmt->bindParam(':client_id', $clientId, PDO::PARAM_INT);
//     $stmt->execute();
    
//      return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

}