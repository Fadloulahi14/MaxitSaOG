<?php

namespace App\Entity;

use App\core\AbstractEntity;

class ProduitEntity extends AbstractEntity
{
    private int $id;
    private string $libelle;
    private float $prix;
    private int $qteStock;

    public function __construct(int $id = 0, string $libelle = '', float $prix = 0.0, int $qteStock = 0)
    {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->prix = $prix;
        $this->qteStock = $qteStock;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function getQteStock(): int
    {
        return $this->qteStock;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setLibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }

    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
    }

    public function setQteStock(int $qteStock): void
    {
        $this->qteStock = $qteStock;
    }

    public static function toObject(array $data): static
    {
        return new static(
            $data['id'] ?? 0,
            $data['libelle'] ?? '',
            $data['prix'] ?? 0.0,
            $data['qteStock'] ?? 0
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'libelle' => $this->libelle,
            'prix' => $this->prix,
            'qteStock' => $this->qteStock
        ];
    }
}