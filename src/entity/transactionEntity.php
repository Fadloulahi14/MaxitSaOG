<?php 
namespace App\Entity;
class TransactionEntity{
    private int $id;
    private int $compteId;
    private string $date;
    private float $montant;
    private string $type;
    private string $description;

    public function __construct(
        int $id,
        int $compteId,
        string $date,
        float $montant,
        string $type,
        string $description
    ) {
        $this->id = $id;
        $this->compteId = $compteId;
        $this->date = $date;
        $this->montant = $montant;
        $this->type = $type;
        $this->description = $description;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getCompteId(): int {
        return $this->compteId;
    }
    public function getDate(): string {
        return $this->date;
    }
    public function getMontant(): float {
        return $this->montant;
    }
    public function getType(): string {
        return $this->type;
    }
    public function getDescription(): string {
        return $this->description;
    }
    
}