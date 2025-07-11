<?php 
    namespace App\Entity; 
    use App\core\AbstractEntity ;
  abstract  class PaiementEntity  extends AbstractEntity {
        private int $id;
        private string $date;
        private float $montant;
        private VendeurEntity $vendeur;
        private FactureEntity  $facture;

        public function __construct(int $id = 0, string $date = '', float $montant = 0.0, VendeurEntity|null $vendeur = null, FactureEntity|null $facture = null) {
            $this->id = $id;
            $this->date = $date;
            $this->montant = $montant;
            $this->vendeur = $vendeur;
            $this->facture = $facture;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of date
         */ 
        public function getDate()
        {
                return $this->date;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDate($date)
        {
                $this->date = $date;

                return $this;
        }

        /**
         * Get the value of montant
         */ 
        public function getMontant()
        {
                return $this->montant;
        }

        /**
         * Set the value of montant
         *
         * @return  self
         */ 
        public function setMontant($montant)
        {
                $this->montant = $montant;

                return $this;
        }

        /**
         * Get the value of vendeur
         */ 
        public function getVendeur()
        {
                return $this->vendeur;
        }

        /**
         * Set the value of vendeur
         *
         * @return  self
         */ 
        public function setVendeur($vendeur)
        {
                $this->vendeur = $vendeur;

                return $this;
        }

        /**
         * Get the value of facture
         */ 
        public function getFacture()
        {
                return $this->facture;
        }

        /**
         * Set the value of facture
         *
         * @return  self
         */ 
        public function setFacture($facture)
        {
                $this->facture = $facture;

                return $this;
        }

        public static function toObject(array $data): static {
            return new static(
                $data['id'] ?? 0,
                $data['date'] ?? '',
                $data['montant'] ?? 0.0,
                
            );
        }

        
    }

