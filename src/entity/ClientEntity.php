<?php

namespace App\Entity;

class ClientEntity extends PersonneClass 
{
    private string $telephone;
    private array $commandes = [];

    public function __construct(int $id = 0, string $nom = '', string $prenom = '', string $telephone = '') 
    {
        parent::__construct($id, $nom, $prenom, TypeEnum::CLIENT);
        $this->telephone = $telephone;
    }

    public function getTelephone(): string 
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void 
    {
        $this->telephone = $telephone;
    }

    public function getCommandes(): array
    {
        return $this->commandes;
    }

    public function addCommande($commande): self
    {
        $this->commandes[] = $commande;
        return $this;
    }

    public function setCommandes(array $commandes): self
    {
        $this->commandes = $commandes;
        return $this;
    }

    public static function toObject(array $data): static 
    {
        $client = new static(
            $data['id'] ?? 0,
            $data['nom'] ?? '',
            $data['prenom'] ?? '',
            $data['telephone'] ?? ''
        );
        
        if (isset($data['commandes']) && is_array($data['commandes'])) {
            $client->setCommandes($data['commandes']);
        }
        
        return $client;
    }

    public function toArray(): array 
    {
        return [
            'id' => $this->getId(),
            'nom' => $this->getNom(),
            'prenom' => $this->getPrenom(),
            'telephone' => $this->telephone,
            'commandes' => $this->commandes,
            'type' => $this->type->value
        ];
    }
}
