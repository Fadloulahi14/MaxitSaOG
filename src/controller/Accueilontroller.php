<?php
namespace App\Controller;
use App\core\AbstractController;

use App\core\Session;

use App\Repository\TransactionRepository;
use App\core\App;


 class Accueilontroller extends AbstractController {
    public function create() { 
         $this -> renderIndex('views/acceuil.html.php');
    }

  

    public function store() {  
         $this -> renderIndex('views/acceuil.html.php');
        
        // $commandeRepo = new CommandeRepository();
        // $commandes = $commandeRepo->findAll(); // Ajoute cette méthode dans CommandeRepository
        // $this->renderIndex('commande/liste.html.php', ['commandes' => $commandes]);
    }
    public function edit() {
        $session = App::getDependency('session');
        $client = $session->get('Client');
        
        if (!$client) {
            header('Location: /');
            exit();
        }

        $numero = $client['numeroTelephone'] ?? $client['telephone'] ?? '';
        $solde = $client['solde'] ?? 0;
        $compteId = $client['compte_id'] ?? null;

        $transactions = [];
        if ($compteId) {
            $transactionRepo = new TransactionRepository();
            $transactions = $transactionRepo->findByCompteId($compteId);
        }

        $this->renderIndex('views/acceuil.html.php', 
        [
            'numero' => $numero,
            'solde' => $solde,
            'transactions' => $transactions
        ]);
    }
    public function show(){
    }
    public function delete() {
    }
    public function index(){
        // $commandeRepo = new AcceuilRepository();
        // $commandes = $commandeRepo->findAll();
        // $this->renderIndex('commande/liste.html.php', ['commandes' => $commandes]);
    }

    public function transactions() {
        $session = App::getDependency('session');
        $client = $session->get('Client');
        
        if (!$client) {
            header('Location: /');
            exit();
        }

        $numero = $client['numeroTelephone'] ?? $client['telephone'] ?? '';
        $solde = $client['solde'] ?? 0;
        $compteId = $client['compte_id'] ?? null;

        $transactions = [];
        if ($compteId) {
            $transactionRepo = new TransactionRepository();
        
            $date = $_GET['date'] ?? null;
            $type = $_GET['type'] ?? null;
        
            $transactions = $transactionRepo->findByCompteIdWithFilters($compteId, $date, $type);
        }

        $this->renderIndex('views/transactions.html.php', [
            'numero' => $numero,
            'solde' => $solde,
            'transactions' => $transactions
        ]);
    }
}