<?php 
  namespace App\Entity;
  use App\core\AbstractEntity;

   abstract class PersonneClass extends AbstractEntity {
    protected int $id; 
    protected string $nom;
    protected string $prenom;
    protected TypeEnum $type;

    public function __construct( $id=0,   $nom='',  $prenom='', TypeEnum $type ) {
      $this->id = $id;
      $this->nom = $nom;
      $this->prenom = $prenom;
      $this->type = $type;
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
    

    public function  setid(int $id): void {
      $this->id = $id;
    }
    public function setNom(string $nom): void {
      $this->nom = $nom;
    }
    public function setPrenom(string $prenom): void {
      $this->prenom = $prenom;
    }

    // public static function toObject(array $data): static {
    //     return new static(
    //         $data['id'] ?? 0,
    //         $data['nom'] ?? '',
    //         $data['prenom'] ?? '',
    //         $data['type'] ?? null
    //     );
    // }

    // public function toArray(): array {
    //     return [
    //         'id' => $this->id,
    //         'nom' => $this->nom,
    //         'prenom' => $this->prenom,
    //         'type' => $this->type
    //     ];
    // }

   
    
}
