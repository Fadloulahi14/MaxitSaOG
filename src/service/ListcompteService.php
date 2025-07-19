<?php
namespace App\Service;

use App\Repository\ListcompteRepository;

class ListcompteService {
    private ListcompteRepository $listcompteRepository;
    
    public function __construct() {
        $this->listcompteRepository = new ListcompteRepository();
    }
    
    public function getCompteSecondairesClient($clientId): array {
        return $this->listcompteRepository->getCompteSecondairesByClient($clientId);
    }
    
    public function getNombreCompteSecondaires($clientId): int {
        return $this->listcompteRepository->countCompteSecondairesByClient($clientId);
    }
    
    public function getTotalSoldeCompteSecondaires($clientId): float {
        return $this->listcompteRepository->getTotalSoldeCompteSecondaires($clientId);
    }
    
    public function formaterComptesPourAffichage($comptes): array {
        $comptesFormats = [];
        
        foreach ($comptes as $compte) {
            $comptesFormats[] = [
                'id' => $compte['id'],
                'telephone' => $compte['numerotelephone'],
                'solde' => number_format($compte['solde'], 0, ',', ' '),
                'solde_brut' => $compte['solde'],
                'date_creation' => date('Y-m-d H:i:s'), // Date actuelle par défaut
                'statut' => $this->determinerStatutCompte($compte['solde'])
            ];
        }
        
        return $comptesFormats;
    }
    
    public function definirComptePrincipal($clientId, $compteId): bool {
        
      
        $compte = $this->listcompteRepository->getCompteById($compteId);
        if (!$compte || $compte['id_client'] != $clientId) {
            return false;
        }
        
        // Changer le compte principal
        return $this->listcompteRepository->changerComptePrincipal($clientId, $compteId);
    }
    
    private function determinerStatutCompte($solde): string {
        if ($solde > 100000) {
            return 'Actif';
        } elseif ($solde > 0) {
            return 'Actif';
        } else {
            return 'Limité';
        }
    }
}