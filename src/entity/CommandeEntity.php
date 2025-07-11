<?php

namespace App\Entity;

use App\core\AbstractEntity;

class CommandeEntity extends AbstractEntity
{
    private int $id;
    private string $date;
    private float $montant;
    private int $clientId;
    private int $vendeurId;
    private ?int $factureId;
    private array $produitCommandes = [];

    public function __construct(
        int $id = 0, 
        string $date = '', 
        float $montant = 0.0, 
        int $clientId = 0, 
        int $vendeurId = 0, 
        ?int $factureId = null
    ) {
        $this->id = $id;
        $this->date = $date;
        $this->montant = $montant;
        $this->clientId = $clientId;
        $this->vendeurId = $vendeurId;
        $this->factureId = $factureId;
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

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getVendeurId(): int
    {
        return $this->vendeurId;
    }

    public function getFactureId(): ?int
    {
        return $this->factureId;
    }

    public function getProduitCommandes(): array
    {
        return $this->produitCommandes;
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

    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function setVendeurId(int $vendeurId): void
    {
        $this->vendeurId = $vendeurId;
    }

    public function setFactureId(?int $factureId): void
    {
        $this->factureId = $factureId;
    }

    public function addProduitCommande($produitCommande): self
    {
        $this->produitCommandes[] = $produitCommande;
        return $this;
    }

    public function setProduitCommandes(array $produitCommandes): self
    {
        $this->produitCommandes = $produitCommandes;
        return $this;
    }

    public static function toObject(array $data): static
    {
        return new static(
            $data['id'] ?? 0,
            $data['date'] ?? '',
            $data['montant'] ?? 0.0,
            $data['client_id'] ?? 0,
            $data['vendeur_id'] ?? 0,
            $data['facture_id'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'montant' => $this->montant,
            'client_id' => $this->clientId,
            'vendeur_id' => $this->vendeurId,
            'facture_id' => $this->factureId,
            'produitCommandes' => array_map(fn($p) => method_exists($p, 'toArray') ? $p->toArray() : $p, $this->produitCommandes)
        ];
    }
}