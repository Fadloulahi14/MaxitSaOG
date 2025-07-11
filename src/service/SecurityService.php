<?php
namespace App\Service;

use App\Repository\PersonneRepository;
use App\core\Validator;
use App\public\Uploader;

class SecurityService {
    private PersonneRepository $personneRepository;
    private TwilioService $twilioService;
    private Validator $validator;
    private $uploader;
    
    public function __construct() {
        $this->personneRepository = new PersonneRepository();
        $this->twilioService = new TwilioService();
        $this->validator = Validator::getInstance();
        
        // Inclusion de la classe Uploader
        require_once __DIR__ . '/../../public/upload/Uploader.php';
        $this->uploader = new Uploader();
    }
    
 
    // public function seConnecterAgent($login, $password): ?array {
    //     if (empty($login) || empty($password)) {
    //         return null;
    //     }
        
    //     $user = $this->personneRepository->selectByLoginAndPassword($login);
        
    //     if ($user && password_verify($password, $user['motdepasse'])) {
    //         return $user;
    //     }
        
    //     return null;
    // }
    
   
    public function seConnecterClient($telephone): ?array {
        if (empty($telephone)) {
            return null;
        }
        
        $telephone = preg_replace('/[^0-9]/', '', $telephone);
        
        return $this->personneRepository->selectByPhone($telephone);
    }
    
    public function creerClient($donnees): ?int {
        // Validation avec Validator
        $this->validator->validate($donnees, [
            'nom' => ['required'],
            'prenom' => ['required'],
            'adresse' => ['required'],
            'telephone' => ['required', 'isSenegalPhone'],
            'cni' => ['required', 'isCNI']
        ]);
        
        $errors = $this->validator->getErrors();
        if (!empty($errors)) {
            throw new \RuntimeException(implode(', ', $errors));
        }
        
        $telephone = preg_replace('/[^0-9]/', '', $donnees['telephone']);
        $cni = preg_replace('/[^0-9]/', '', $donnees['cni']);
        
        if ($this->personneRepository->clientExistsByPhone($telephone)) {
            throw new \RuntimeException("Un client avec ce numéro de téléphone existe déjà");
        }
        
        if ($this->personneRepository->cniExists($cni)) {
            throw new \RuntimeException("Ce numéro CNI est déjà utilisé");
        }
        
        $photoRecto = $this->uploader->gererUploadPhoto('photo-recto');
        $photoVerso = $this->uploader->gererUploadPhoto('photo-verso');
        
        $clientId = $this->personneRepository->createClient(
            $donnees['nom'],
            $donnees['prenom'],
            $donnees['adresse'],
            $telephone,
            $cni,
            $photoRecto,
            $photoVerso
        );
        
        if ($clientId) {
            $this->twilioService->envoyerMessageValidation($telephone, $donnees['prenom']);
        }
        
        return $clientId;
    }
    
   
    
    // public function seDeconnecter() {
    //     // Logique de déconnexion si nécessaire
    // }
}