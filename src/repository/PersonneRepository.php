<?php
    namespace App\Repository;

    use App\core\Database;
    use PDO;
    use App\core\App;


    class PersonneRepository{
        
        private PDO $pdo;
        public function __construct(){
            $this->pdo = App::getDependency('database');
   
        }
       
        
        public function selectByLoginAndPassword($login): ?array {
        try {
            $sql = "SELECT * FROM serviceCommercial WHERE login = :login";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':login', $login, PDO::PARAM_STR);
            $stmt->execute();
            
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $data ?: null;
             
        } catch (\PDOException $e) {
            error_log("Erreur selectByLoginAndPassword: " . $e->getMessage());
            throw new \RuntimeException("Erreur de recherche: " . $e->getMessage());
        }       
    }

    public function selectByPhone($phone): ?array {
        try {
            $sql = "SELECT c.id as client_id, c.nom, c.prenom, c.adresse, c.telephone, 
                   co.id as compte_id, co.numerotelephone, co.solde, co.estprincipale 
            FROM client c 
            INNER JOIN compte co ON c.id = co.id_client 
            WHERE c.telephone = :telephone AND co.estprincipale = true";
            
            error_log("Recherche client avec téléphone: " . $phone);
            error_log("SQL: " . $sql);
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':telephone', $phone, PDO::PARAM_STR);
            $stmt->execute();
            
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            error_log("Résultat de la requête: " . print_r($data, true));
         
        //     return $data ?: null; die();
         return $data ?: null;
        } catch (\PDOException $e) {
            error_log("Erreur selectByPhone: " . $e->getMessage());
            throw new \RuntimeException("Erreur de recherche: " . $e->getMessage());
        }       
    }

    public function createClient($nom, $prenom, $adresse, $telephone, $cni, $photoRecto = null, $photoVerso = null): ?int {
        try {
            
            // var_dump($nom, $prenom, $adresse, $telephone, $cni, $photoRecto, $photoVerso);
            // die();

            $this->pdo->beginTransaction();
            
            $sql = "INSERT INTO client (nom, prenom, adresse, telephone) VALUES (:nom, :prenom, :adresse, :telephone)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
            $stmt->execute();
            
            $clientId = $this->pdo->lastInsertId();
            
            $sqlCompte = "INSERT INTO compte (numerotelephone, numerocni, photorecto, photoverso, solde, estprincipale, id_client) 
                         VALUES (:telephone, :cni, :photorecto, :photoverso, 0, true, :clientId)";
            $stmtCompte = $this->pdo->prepare($sqlCompte);
            $stmtCompte->bindParam(':telephone', $telephone, PDO::PARAM_STR);
            $stmtCompte->bindParam(':cni', $cni, PDO::PARAM_INT);
            $stmtCompte->bindParam(':photoRecto', $photoRecto, PDO::PARAM_STR);
            $stmtCompte->bindParam(':photoVerso', $photoVerso, PDO::PARAM_STR);
            $stmtCompte->bindParam(':clientId', $clientId, PDO::PARAM_INT);
            $stmtCompte->execute();
            
            $this->pdo->commit();
            return $clientId;
            
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            error_log("Erreur createClient: " . $e->getMessage());
            throw new \RuntimeException("Erreur lors de la création du client: " . $e->getMessage());
        }
    }

    public function clientExistsByPhone($phone): bool {
        try {
            $sql = "SELECT COUNT(*) FROM client WHERE telephone = :telephone";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':telephone', $phone, PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->fetchColumn() > 0;
        } catch (\PDOException $e) {
            throw new \RuntimeException("Erreur de vérification: " . $e->getMessage());
        }
    }

    public function cniExists($cni): bool {
        try {
            $sql = "SELECT COUNT(*) FROM compte WHERE numeroCNI = :cni";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':cni', $cni, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchColumn() > 0;
        } catch (\PDOException $e) {
            throw new \RuntimeException("Erreur de vérification CNI: " . $e->getMessage());
        }
    }

    public function testConnection(): bool {
        try {
            $stmt = $this->pdo->query("SELECT 1");
            return $stmt !== false;
        } catch (\PDOException $e) {
            error_log("Erreur de connexion DB: " . $e->getMessage());
            return false;
        }
    }
}