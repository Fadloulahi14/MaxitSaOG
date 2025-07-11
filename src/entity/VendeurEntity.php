<?php
  namespace App\Entity;
  use  App\core;
  use  App\Entity\PersonneClass;
 

  class VendeurEntity extends PersonneClass {
    private string $login;
    private string $password;
    private array $paiements = [];
    private array $commandes = [];
  

    public function __construct(int $id = 0, string $nom = '', string $prenom = '', string $login = '', string $password = '') {
      parent::__construct($id, $nom, $prenom, TypeEnum::VENDEUR);
      $this->login = $login;
      $this->password = $password;
    
     
    }

    public function getLogin(): string {
      return $this->login;
    }

    public function getPassword(): string {
      return $this->password;
    }

    public function setLogin(string $login): void {
      $this->login = $login;
    }

    public function setPassword(string $password): void {
      $this->password = $password;
    }

    public function getPaiements(): array
    {
        return $this->paiements;
    }

    public function addPaiement($paiement): self
    {
        $this->paiements[] = $paiement;
        return $this;
    }

    public function setPaiements(array $paiements): self
    {
        $this->paiements = $paiements;
        return $this;
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
        $vendeur = new static(
            $data['id'] ?? 0,
            $data['nom'] ?? '',
            $data['prenom'] ?? '',
            $data['login'] ?? '',
            $data['password'] ?? ''
        );
        
        if (isset($data['paiements']) && is_array($data['paiements'])) {
            $vendeur->setPaiements($data['paiements']);
        }
        
        if (isset($data['commandes']) && is_array($data['commandes'])) {
            $vendeur->setCommandes($data['commandes']);
        }
        
        return $vendeur;
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'nom' => $this->getNom(),
            'prenom' => $this->getPrenom(),
            'login' => $this->login, 
            'password'=> $this ->password,
            'paiements' => array_map(fn($p)=>method_exists($p, 'toArray')? $p->toArray() : $p, $this->paiements),
            'commandes' => array_map(fn($c)=>method_exists($c, 'toArray')? $c->toArray() : $c, $this->commandes),
            'type'=> $this -> type-> value
        ];
    }
  }
