<?php
namespace App\Controller;

use App\core\AbstractController;
use App\core\Session;
use App\core\Validator;
use App\Repository\TransactionRepository;
use App\Service\CompteSecondaireService;
use App\Service\ListcompteService;

class CompteSecondaireController extends AbstractController {
    
    private Validator $validator;
    private CompteSecondaireService $compteSecondaireService;
    private TransactionRepository $transactionRepository;
    private ListcompteService $listcompteService;
    
    public function __construct() {
        $this->baseLayout = 'base';
        $this->validator = Validator::getInstance();
        $this->compteSecondaireService = new CompteSecondaireService();
        $this->transactionRepository = new TransactionRepository();
        $this->listcompteService = new ListcompteService();
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $session = Session::getInstance();
            $client = $session->get('Client');
            
            if (!$client) {
                header('Location: /');
                exit();
            }

            Validator::resetError();
            
            $donnees = [
                'telephone' => trim($_POST['telephone'] ?? ''),
                'solde' => trim($_POST['solde'] ?? '0')
            ];
            
           
            $this->validator->validate($donnees, [
                'telephone' => ['required', 'isSenegalPhone']
            ]);
            
            $errors = $this->validator->getErrors();
            
            
            $soldeInitial = (float)$donnees['solde'];
            if ($soldeInitial < 0) {
                $errors['solde'] = 'Le solde ne peut pas être négatif';
            }
            
            
            $soldePrincipal = (float)$client['solde'];
            if (!$this->compteSecondaireService->verifierSoldeDisponible($soldeInitial, $soldePrincipal)) {
                $errors['solde'] = 'Solde insuffisant sur votre compte principal';
            }
            
           
            $telephone = preg_replace('/[^0-9]/', '', $donnees['telephone']);
            if ($this->compteSecondaireService->verifierTelephoneExistant($donnees['telephone'])) {
                $errors['telephone'] = 'Ce numéro de téléphone est déjà utilisé';
            }
            
            if (empty($errors)) {
                try {
                    $clientId = $client['client_id'];
                    $comptePrincipalId = $client['compte_id'];
                    
                    // Créer le compte secondaire
                    $compteSecondaireId = $this->compteSecondaireService->creerCompteSecondaire(
                        $clientId,
                        $donnees['telephone'],
                        $soldeInitial
                    );
                    
                    if (!$compteSecondaireId) {
                        throw new \Exception('Erreur lors de la création du compte secondaire');
                    }
                    
                   
                    if ($soldeInitial > 0) {
                        if (!$this->compteSecondaireService->effectuerTransfertInitial(
                            $comptePrincipalId,
                            $compteSecondaireId,
                            $soldeInitial
                        )) {
                            throw new \Exception('Erreur lors du transfert initial');
                        }
                        
                      
                        $nouveauSoldePrincipal = $soldePrincipal - $soldeInitial;
                        if (!$this->compteSecondaireService->mettreAJourSoldePrincipal(
                            $comptePrincipalId,
                            $nouveauSoldePrincipal
                        )) {
                            throw new \Exception('Erreur lors de la mise à jour du solde');
                        }
                        
                        // Mettre à jour la session
                        $client['solde'] = $nouveauSoldePrincipal;
                        $session->set('Client', $client);
                    }
                    
                    $success = 'Compte secondaire créé avec succès !';
                    $this->renderIndex('views/compteSecondaire.html.php', [
                        'numero' => $client['numerotelephone'] ?? $client['telephone'] ?? '',
                        'solde' => $client['solde'],
                        'success' => $success
                    ]);
                    
                } catch (\Exception $e) {
                    error_log("Erreur création compte secondaire: " . $e->getMessage());
                    $errors['global'] = 'Erreur lors de la création du compte : ' . $e->getMessage();
                    $this->renderIndex('views/compteSecondaire.html.php', [
                        'error' => $errors,
                        'donnees' => $donnees,
                        'numero' => $client['numerotelephone'] ?? $client['telephone'] ?? '',
                        'solde' => $client['solde']
                    ]);
                }
            } else {
                $this->renderIndex('views/compteSecondaire.html.php', [
                    'error' => $errors,
                    'donnees' => $donnees,
                    'numero' => $client['numerotelephone'] ?? $client['telephone'] ?? '',
                    'solde' => $client['solde']
                ]);
            }
        } else {
            $session = Session::getInstance();
            $client = $session->get('Client');
            
            if (!$client) {
                header('Location: /');
                exit();
            }

            $this->renderIndex('views/compteSecondaire.html.php', [
                'numero' => $client['numerotelephone'] ?? $client['telephone'] ?? '',
                'solde' => $client['solde']
            ]);
        }
    }

    public function definirPrincipal() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $session = Session::getInstance();
            
            $client = $session->get('Client');
           
            
            if (!$client) {
                header('Location: /');
                exit();
            }
            
            $compteId = $_POST['compte_id'] ?? null;

             
            
            if (!$compteId) {
                header('Location: /compte-secondaire/liste');
                exit();
            }
            
            $clientId = $client['client_id'];

           
            
            if ($this->listcompteService->definirComptePrincipal($clientId, $compteId)) {

                
                header('Location: /list');
            } else {
                // Rediriger vers la liste avec erreur
                header('Location: /');
            }
            exit();
        }
        
        header('Location: /compte-secondaire/liste');
        exit();
    }

    public function edit() {}
    public function store() {}
    public function show() {}
    public function delete() {}
    public function index() {}

    public function liste() {
        $session = Session::getInstance();
        
        $client = $session->get('Client');
        
        if (!$client) {
            header('Location: /');
            exit();
        }
        
        $clientId = $client['client_id'];
        
     
        $comptesSecondaires = $this->listcompteService->getCompteSecondairesClient($clientId);

       
        $comptesFormats = $this->listcompteService->formaterComptesPourAffichage($comptesSecondaires);
        
        // Récupérer les statistiques
        $nombreComptes = $this->listcompteService->getNombreCompteSecondaires($clientId);
        $totalSolde = $this->listcompteService->getTotalSoldeCompteSecondaires($clientId);
        
        $this->renderIndex('views/listcompte.html.php', [
            'numero' => $client['numerotelephone'] ?? $client['telephone'] ?? '',
            'solde' => $client['solde'],
            'comptes_secondaires' => $comptesFormats,
            'nombre_comptes' => $nombreComptes,
            'total_solde' => number_format($totalSolde, 0, ',', ' ')
        ]);
    }
}