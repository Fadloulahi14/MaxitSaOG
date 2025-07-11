<?php
namespace App\Controller;

use App\core\AbstractController;
use App\core\Session;
use App\Service\SecurityService;
use App\core\Validator;
use App\Repository\TransactionRepository;

class ControllerSeuriter extends AbstractController {

    private SecurityService $securityService;
    
    public function __construct() {
        $this->baseLayout = 'login';
        $this->securityService = new SecurityService();
    }

   
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $telephone = $_POST['telephone'] ?? '';
            
            error_log("Tentative de connexion avec le numéro: " . $telephone);
            
            Validator::resetError();
            
            
            if (Validator::isEmpty($telephone)) {
                Validator::addError('telephone', 'Le numéro de téléphone est obligatoire');
            } else {
             
                $telephone = preg_replace('/[^0-9]/', '', $telephone);
                
                if (!preg_match('/^[0-9]{9}$/', $telephone)) {
                    Validator::addError('telephone', 'Le numéro de téléphone doit contenir exactement 9 chiffres');
                }
            }
            
            $errors = Validator::getError();
            
            if (empty($errors)) {
                try {
                    $result = $this->securityService->seConnecterClient($telephone);
                    if ($result) {
                        $session = Session::getInstance();
                        $session->set('Client', $result);
                        $session->set('user_type', 'client');
                        
                        header('Location: /store');
                        exit();
                    } else {
                        $errors['global'] = "Aucun compte trouvé avec ce numéro de téléphone: " . $telephone;
                    }
                } catch (\Exception $e) {
                    $errors['global'] = "Erreur de connexion: " . $e->getMessage();
                }
            }
            
            $this->renderIndex('login/login.html.php', ['error' => $errors]);
        } else {
            $this->store();
        }
    }

    public function store() {
        $this->renderIndex('login/login.html.php');
    }

    public function inscription() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            error_log("Données POST reçues: " . print_r($_POST, true));
            error_log("Fichiers reçus: " . print_r($_FILES, true));
            
            Validator::resetError();
            
           
            $donnees = [
                'nom' => trim($_POST['nom'] ?? ''),
                'prenom' => trim($_POST['prenom'] ?? ''),
                'cni' => trim($_POST['cni'] ?? ''),
                'adresse' => trim($_POST['adresse'] ?? ''),
                'telephone' => trim($_POST['tel'] ?? '') 
            ];
            
           
            if (Validator::isEmpty($donnees['nom'])) {
                Validator::addError('nom', 'Le nom est obligatoire');
            }
            
            if (Validator::isEmpty($donnees['prenom'])) {
                Validator::addError('prenom', 'Le prénom est obligatoire');
            }
            
            if (Validator::isEmpty($donnees['cni'])) {
                Validator::addError('cni', 'Le numéro CNI est obligatoire');
            } else {
                $cni = preg_replace('/[^0-9]/', '', $donnees['cni']);
                if (!preg_match('/^[0-9]{10,13}$/', $cni)) {
                    Validator::addError('cni', 'Le numéro CNI doit contenir entre 10 et 13 chiffres');
                }
            }
            
            if (Validator::isEmpty($donnees['adresse'])) {
                Validator::addError('adresse', 'L\'adresse est obligatoire');
            }
            
            if (Validator::isEmpty($donnees['telephone'])) {
                Validator::addError('tel', 'Le numéro de téléphone est obligatoire');
            } else {
                $telephone = preg_replace('/[^0-9]/', '', $donnees['telephone']);
                if (!preg_match('/^[0-9]{9}$/', $telephone)) {
                    Validator::addError('tel', 'Le numéro de téléphone doit contenir exactement 9 chiffres');
                }
            }
            
            // Validation des photos (obligatoires)
            if (!isset($_FILES['photo-recto']) || $_FILES['photo-recto']['error'] !== UPLOAD_ERR_OK) {
                Validator::addError('photo-recto', 'La photo recto de la CNI est obligatoire');
            }
            
            if (!isset($_FILES['photo-verso']) || $_FILES['photo-verso']['error'] !== UPLOAD_ERR_OK) {
                Validator::addError('photo-verso', 'La photo verso de la CNI est obligatoire');
            }
            
            $errors = Validator::getError();
            
            if (empty($errors)) {
                try {
                    $clientId = $this->securityService->creerClient($donnees);
                    
                    if ($clientId) {
                        
                        $session = Session::getInstance();
                        $session->set('inscription_success', 'Inscription réussie ! Votre compte a été créé avec succès.');
                        
                       
                        header('Location: /');
                        exit();
                    }
                } catch (\Exception $e) {
                    error_log("Erreur inscription: " . $e->getMessage());
                    $errors['global'] = $e->getMessage();
                }
            }
            
            $this->renderIndex('login/inscription.html.php', [
                'error' => $errors,
                'donnees' => $donnees
            ]);
        } else {
            $this->renderIndex('login/inscription.html.php');
        }
    }

    // public function login() {
    //     Validator::resetError();

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $login = $_POST['login'] ?? '';
    //         $password = $_POST['password'] ?? '';

    //         if (Validator::isEmpty($login)) {
    //             Validator::addError('login', 'Le login est obligatoire');
    //         } elseif (!Validator::isEmail($login)) {
    //             Validator::addError('login', 'Le login doit être un email');
    //         }

    //         if (Validator::isEmpty($password)) {
    //             Validator::addError('password', 'Le mot de passe est obligatoire');
    //         }

    //         $errors = Validator::getError();
            
    //         if (empty($errors)) {
    //             try {
    //                 $result = $this->securityService->seConnecterAgent($login, $password);
                    
    //                 if ($result) {
    //                     $session = Session::getInstance();
    //                     $session->set('Agent', $result);
    //                     $session->set('user_type', 'agent');
    //                     header('Location: /store');
    //                     exit();
    //                 } else {
    //                     $errors['global'] = "Login ou mot de passe incorrect";
    //                 }
    //             } catch (\Exception $e) {
    //                 $errors['global'] = "Erreur de connexion: " . $e->getMessage();
    //             }
    //         }
            
    //         $this->renderIndex('login/agent-login.html.php', ['error' => $errors]);
    //     } else {
    //         $this->renderIndex('login/agent-login.html.php');
    //     }
    // }

    public function logout() {
        $session = Session::getInstance();
        $session->destroy();
        header('Location: /');
        exit();
    }

    public function edit() {}
    public function show() {}
    public function delete() {}
    public function index() {
        $session = Session::getInstance();
        $client = $session->get('Client');
        
        if (!$client) {
            header('Location: /');
            exit();
        }

  
        $numero = $client['numeroTelephone'] ?? $client['telephone'] ?? '';
        $solde = $client['solde'] ?? 0;
        $compteId = $client['compte_id'] ?? null;

        
        $transactions = [];
        if ($compteId) {
            $transactionRepo = new TransactionRepository();
            $transactions = $transactionRepo->findByCompteId($compteId);
        }

    
        $this->renderIndex('views/acceuil.html.php', [
            'numero' => $numero,
            'solde' => $solde,
            'transactions' => $transactions
        ]);
    }
}