<?php

namespace App\Entity;

use App\core\AbstractEntity;

class ProduitCommander extends AbstractEntity
{
    private int $id;
    private int $commandeId;
    private int $produitId;
    private int $qteComde;
    private float $montant;

    public function __construct(int $id = 0, int $commandeId = 0, int $produitId = 0, int $qteComde = 0, float $montant = 0.0)
    {
        $this->id = $id;
        $this->commandeId = $commandeId;
        $this->produitId = $produitId;
        $this->qteComde = $qteComde;
        $this->montant = $montant;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCommandeId(): int
    {
        return $this->commandeId;
    }

    public function getProduitId(): int
    {
        return $this->produitId;
    }

    public function getQteComde(): int
    {
        return $this->qteComde;
    }

    public function getMontant(): float
    {
        return $this->montant;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setCommandeId(int $commandeId): void
    {
        $this->commandeId = $commandeId;
    }

    public function setProduitId(int $produitId): void
    {
        $this->produitId = $produitId;
    }

    public function setQteComde(int $qteComde): void
    {
        $this->qteComde = $qteComde;
    }

    public function setMontant(float $montant): void
    {
        $this->montant = $montant;
    }

    public static function toObject(array $data): static
    {
        return new static(
            $data['id'] ?? 0,
            $data['commande_id'] ?? 0,
            $data['produit_id'] ?? 0,
            $data['qteComde'] ?? 0,
            $data['montant'] ?? 0.0
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'commande_id' => $this->commandeId,
            'produit_id' => $this->produitId,
            'qteComde' => $this->qteComde,
            'montant' => $this->montant
        ];
    }
}