<?php
namespace App\Service;

use App\Repository\PersonneRepository;

class SecurityService {
    private PersonneRepository $personneRepository;
    
    public function __construct() {
        $this->personneRepository = new PersonneRepository();
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
        $champsObligatoires = ['nom', 'prenom', 'adresse', 'telephone', 'cni'];
        
        foreach ($champsObligatoires as $champ) {
            if (empty($donnees[$champ])) {
                throw new \RuntimeException("Le champ $champ est obligatoire");
            }
        }
        
        $telephone = preg_replace('/[^0-9]/', '', $donnees['telephone']);
        if (!preg_match('/^[0-9]{9}$/', $telephone)) {
            throw new \RuntimeException("Le numéro de téléphone doit contenir exactement 9 chiffres");
        }
        
        $cni = preg_replace('/[^0-9]/', '', $donnees['cni']);
        if (!preg_match('/^[0-9]{10,13}$/', $cni)) {
            throw new \RuntimeException("Le numéro CNI doit contenir entre 10 et 13 chiffres");
        }
        
        if ($this->personneRepository->clientExistsByPhone($telephone)) {
            throw new \RuntimeException("Un client avec ce numéro de téléphone existe déjà");
        }
        
        if ($this->personneRepository->cniExists($cni)) {
            throw new \RuntimeException("Ce numéro CNI est déjà utilisé");
        }
        
        $photoRecto = $this->gererUploadPhoto('photo-recto');
        $photoVerso = $this->gererUploadPhoto('photo-verso');
        
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
    
    private function gererUploadPhoto($nomChamp): ?string {
        if (!isset($_FILES[$nomChamp]) || $_FILES[$nomChamp]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
        
        $file = $_FILES[$nomChamp];
        
        
        $typesAutorises = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!in_array($file['type'], $typesAutorises)) {
            throw new \RuntimeException("Type de fichier non autorisé pour $nomChamp. Utilisez JPG, JPEG ou PNG.");
        }
        
        if ($file['size'] > 5 * 1024 * 1024) {
            throw new \RuntimeException("Le fichier $nomChamp est trop volumineux (max 5MB)");
        }
        
        $uploadDir = __DIR__ . '/../../uploads/cni/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nomFichier = uniqid() . '_' . $nomChamp . '.' . $extension;
        $cheminComplet = $uploadDir . $nomFichier;
        
        if (move_uploaded_file($file['tmp_name'], $cheminComplet)) {
            return 'uploads/cni/' . $nomFichier;
        } else {
            throw new \RuntimeException("Erreur lors de l'upload de $nomChamp");
        }
    }
    
    // public function seDeconnecter() {
    //     // Logique de déconnexion si nécessaire
    // }
}