<?php
namespace App\Controller;

use App\core\AbstractController;
use App\core\Session;
use App\Service\SecurityService;
use App\Service\TwilioService;
use App\core\Validator;
use App\message\MessageFr;
use App\public\Uploader;
use App\core\App;

class ControllerSeuriter extends AbstractController {

    private SecurityService $securityService;
    private TwilioService $twilioService;
    private Validator $validator;
    private $uploader;
    
    public function __construct() {
        $this->baseLayout = 'login';
        $this->securityService = new SecurityService();
        $this->twilioService = new TwilioService();
        $this->validator = App::getDependency('validator');
        
        
        require_once __DIR__ . '/../../public/upload/Uploader.php';
        $this->uploader = new Uploader();
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
                        $session = App::getDependency('session');
                        $session->set('Client', $result);
                        $session->set('user_type', 'client');
                        
                        header('Location: /store');
                        exit();
                    } else {
                        $errors['global'] = MessageFr::TELEPHONE_REQUIRED->value . $telephone;
                    }
                } catch (\Exception $e) {
                    $errors['global'] = MessageFr::ERREUR_CONNEXION->value . $e->getMessage();
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
                $errors['photo-recto'] = MessageFr::PHOTO_RECTO_OBLIGATOIRE->value;
            }
            
            if (!isset($_FILES['photo-verso']) || $_FILES['photo-verso']['error'] !== UPLOAD_ERR_OK) {
                $errors['photo-verso'] = MessageFr::PHOTO_VERSO_OBLIGATOIRE->value;
            }
            
            if (empty($errors)) {
                try {
                  
                    if ($this->securityService->verifierClientExistant($donnees['telephone'])) {
                        throw new \RuntimeException("Un client avec ce numéro de téléphone existe déjà");
                    }
                    
                    if ($this->securityService->verifierCniExistant($donnees['cni'])) {
                        throw new \RuntimeException("Ce numéro CNI est déjà utilisé");
                    }
                    
                    // Gestion des uploads
                    $photoRecto = $this->uploader->gererUploadPhoto('photo-recto');
                    $photoVerso = $this->uploader->gererUploadPhoto('photo-verso');
                    
                  
                    $clientId = $this->securityService->creerClient($donnees, $photoRecto, $photoVerso);
                    
                    if ($clientId) {
                       
                        $telephone = preg_replace('/[^0-9]/', '', $donnees['telephone']);
                        $this->twilioService->envoyerMessageValidation($telephone, $donnees['prenom']);
                        
                        $session =App::getDependency('session');
                        $session->set('inscription_success', MessageFr::INSCRIPTION_REUSSIE->value);
                        
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
        $session = App::getDependency('session');
        $session->destroy();
        header('Location: /');
        exit();
    }

    public function edit() {}
    public function show() {}
    public function delete() {}
    
    public function index() {
        
    }
}
