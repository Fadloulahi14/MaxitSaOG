<?php
namespace App\Service;

use App\core\App;
use App\Repository\PersonneRepository;

class SecurityService {
    private PersonneRepository $personneRepository;
    
    public function __construct() {
        $this->personneRepository =App::getDependency('personneRepository');
    }
    
    public function seConnecterClient($telephone): ?array {
        if (empty($telephone)) {
            return null;
        }
        
        $telephone = preg_replace('/[^0-9]/', '', $telephone);
        
        return $this->personneRepository->selectByPhone($telephone);
    }
    
    public function verifierClientExistant($telephone): bool {
        $telephone = preg_replace('/[^0-9]/', '', $telephone);
        return $this->personneRepository->clientExistsByPhone($telephone);
    }
    
    public function verifierCniExistant($cni): bool {
        return $this->personneRepository->cniExists($cni);
    }
    
    public function creerClient($donnees, $photoRecto, $photoVerso): ?int {
        $telephone = preg_replace('/[^0-9]/', '', $donnees['telephone']);
        $cni = preg_replace('/[^0-9]/', '', $donnees['cni']);
        
        return $this->personneRepository->createClient(
            $donnees['nom'],
            $donnees['prenom'],
            $donnees['adresse'],
            $telephone,
            $cni,
            $photoRecto,
            $photoVerso
        );
    }
}