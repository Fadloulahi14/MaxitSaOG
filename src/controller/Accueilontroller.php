<?php
namespace App\Controller;
use App\core\AbstractController;
use App\Repository\AcceuilRepository;
use App\core\Middleware;

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
    public function edit() {}
    public function show(){
    }
    public function delete() {
    }
    public function index(){
        $commandeRepo = new AcceuilRepository();
        $commandes = $commandeRepo->findAll();
        $this->renderIndex('commande/liste.html.php', ['commandes' => $commandes]);
    }


}