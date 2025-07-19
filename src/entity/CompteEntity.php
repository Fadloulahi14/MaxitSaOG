<?php
namespace App\Entity;
class CompteEntity {
    private int $id;
    private int $clientId;
    private string $numeroTelephone;
    private float $solde;
    private bool $estPrincipale;
    public function __construct(
        int $id,
        int $clientId,
        string $numeroTelephone,
        float $solde,
        bool $estPrincipale
    ) {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->numeroTelephone = $numeroTelephone;
        $this->solde = $solde;
        $this->estPrincipale = $estPrincipale;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getClientId(): int {
        return $this->clientId;
    }

    public function getNumeroTelephone(): string {
        return $this->numeroTelephone;
    }

    public function getSolde(): float {
        return $this->solde;
    }

    public function isEstPrincipale(): bool {
        return $this->estPrincipale;
    }
}