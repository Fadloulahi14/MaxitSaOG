<?php
namespace App\Entity;

class ClientEntity {
    private int $id;
    private string $nom;
    private string $prenom;
    private string $adresse;
    private string $telephone;
    // private int $compteId;
    // private string $numeroTelephone;
    // private float $solde;
    // private bool $estPrincipale;    

    public function __construct(
        int $id,
        string $nom,
        string $prenom,
        string $adresse,
        string $telephone,
     
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        
    }
    public function getId(): int {
        return $this->id;
    }
    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getAdresse(): string {
        return $this->adresse;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    
}