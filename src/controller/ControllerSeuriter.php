<?php
namespace App\Controller;

use App\core\AbstractController;
use App\core\Session;
use App\Service\SecurityService;
use App\core\Validator;
use App\Repository\TransactionRepository;

class ControllerSeuriter extends AbstractController {

    private SecurityService $securityService;
    private Validator $validator;
    
    public function __construct() {
        $this->baseLayout = 'login';
        $this->securityService = new SecurityService();
        $this->validator = Validator::getInstance();
    }

    private function validateForm(array &$data): array {
        $this->validator->validate($data, [
            'nom' => ['required', ['minLength', 3]],
            'prenom' => ['required', ['minLength', 3]],
            'adresse' => ['required'],
            'telephone' => ['required', 'isSenegalPhone'],
            'cni' => ['required', 'isCNI']
        ]);

        return $this->validator->getErrors();
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $telephone = $_POST['telephone'] ?? '';
            
            Validator::resetError();
            
            $data = ['telephone' => $telephone];
            $this->validator->validate($data, [
                'telephone' => ['required', 'isSenegalPhone']
            ]);
            
            $errors = $this->validator->getErrors();
            
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

    public function inscription() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Validator::resetError();
            
            $donnees = [
                'nom' => trim($_POST['nom'] ?? ''),
                'prenom' => trim($_POST['prenom'] ?? ''),
                'cni' => trim($_POST['cni'] ?? ''),
                'adresse' => trim($_POST['adresse'] ?? ''),
                'telephone' => trim($_POST['tel'] ?? '') 
            ];
            
            $errors = $this->validateForm($donnees);
            
            if (!isset($_FILES['photo-recto']) || $_FILES['photo-recto']['error'] !== UPLOAD_ERR_OK) {
                $errors['photo-recto'] = 'La photo recto de la CNI est obligatoire';
            }
            
            if (!isset($_FILES['photo-verso']) || $_FILES['photo-verso']['error'] !== UPLOAD_ERR_OK) {
                $errors['photo-verso'] = 'La photo verso de la CNI est obligatoire';
            }
            
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

    public function store() {
        $this->renderIndex('login/login.html.php');
    }

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
