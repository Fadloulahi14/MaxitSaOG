<?php
namespace App\Service;

use App\Repository\CompteRepository;
use App\Repository\TransactionRepository;

class CompteSecondaireService {
    private CompteRepository $compteRepository;
    private TransactionRepository $transactionRepository;
    
    public function __construct() {
        $this->compteRepository = new CompteRepository();
        $this->transactionRepository = new TransactionRepository();
    }
    
    public function verifierTelephoneExistant($telephone): bool {
        $telephone = preg_replace('/[^0-9]/', '', $telephone);
        return $this->compteRepository->telephoneExists($telephone);
    }
    
    public function verifierSoldeDisponible($soldeInitial, $soldePrincipal): bool {
        return $soldeInitial <= $soldePrincipal;
    }
    
    public function creerCompteSecondaire($clientId, $telephone, $soldeInitial): ?int {
        $telephone = preg_replace('/[^0-9]/', '', $telephone);
        
        return $this->compteRepository->createCompteSecondaire(
            $clientId,
            $telephone,
            $soldeInitial
        );
    }
    
    public function effectuerTransfertInitial($comptePrincipalId, $compteSecondaireId, $montant): bool {
        try {
            // Vérification des paramètres
            if (!$comptePrincipalId || !$compteSecondaireId || $montant <= 0) {
                error_log("Paramètres invalides pour transfert: principal=$comptePrincipalId, secondaire=$compteSecondaireId, montant=$montant");
                return false;
            }
            
            // Transaction de retrait du compte principal
            $retraitId = $this->transactionRepository->createTransaction(
                $comptePrincipalId,
                -$montant,
                'retrait',
                null,
                $compteSecondaireId
            );
            
            if (!$retraitId) {
                error_log("Échec création transaction retrait");
                return false;
            }
            
            // Transaction de dépôt vers le compte secondaire
            $depotId = $this->transactionRepository->createTransaction(
                $compteSecondaireId,
                $montant,
                'depot',
                $comptePrincipalId,
                null
            );
            
            if (!$depotId) {
                error_log("Échec création transaction dépôt");
                return false;
            }
            
            return true;
            
        } catch (\Exception $e) {
            error_log("Erreur dans effectuerTransfertInitial: " . $e->getMessage());
            return false;
        }
    }
    
    public function mettreAJourSoldePrincipal($comptePrincipalId, $nouveauSolde): bool {
        try {
            return $this->compteRepository->updateSolde($comptePrincipalId, $nouveauSolde);
        } catch (\Exception $e) {
            error_log("Erreur mise à jour solde: " . $e->getMessage());
            return false;
        }
    }
}