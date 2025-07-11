<?php

namespace App\Entity;

use App\core\AbstractEntity;

class FactureEntity extends AbstractEntity
{
    private int $id;
    private string $date;
    private float $montant;
    private StatusEnum $statut;
    private float $montantRestant;
    private int $commandeId;
    private array $paiements = [];

    public function __construct(
        int $id = 0, 
        string $date = '', 
        float $montant = 0.0, 
        StatusEnum $statut = StatusEnum::IMPAYE, 
        float $montantRestant = 0.0,
        int $commandeId = 0
    ) {
        $this->id = $id;
        $this->date = $date;
        $this->montant = $montant;
        $this->statut = $statut;
        $this->montantRestant = $montantRestant;
        $this->commandeId = $commandeId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getMontant(): float
    {
        return $this->montant;
    }

    public function getStatut(): StatusEnum
    {
        return $this->statut;
    }

    public function getMontantRestant(): float
    {
        return $this->montantRestant;
    }

    public function getCommandeId(): int
    {
        return $this->commandeId;
    }

    public function getPaiements(): array
    {
        return $this->paiements;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function setMontant(float $montant): void
    {
        $this->montant = $montant;
    }

    public function setStatut(StatusEnum $statut): void
    {
        $this->statut = $statut;
    }

    public function setMontantRestant(float $montantRestant): void
    {
        $this->montantRestant = $montantRestant;
    }

    public function setCommandeId(int $commandeId): void
    {
        $this->commandeId = $commandeId;
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

    public static function toObject(array $data): static
    {
        return new static(
            $data['id'] ?? 0,
            $data['date'] ?? '',
            $data['montant'] ?? 0.0,
            StatusEnum::from($data['statut'] ?? 'impaye'),
            $data['montantRestant'] ?? 0.0,
            $data['commande_id'] ?? 0
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'montant' => $this->montant,
            'statut' => $this->statut->value,
            'montantRestant' => $this->montantRestant,
            'commande_id' => $this->commandeId,
            'paiements' => array_map(fn($p) => method_exists($p, 'toArray') ? $p->toArray() : $p, $this->paiements)
        ];
    }
}
