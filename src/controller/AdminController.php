<?php
namespace App\Controller;
use App\core\AbstractController;
use App\Repository\AcceuilRepository;
use App\core\Middleware;
use App\core\Session;

use App\Repository\TransactionRepository;


 class AdminController extends AbstractController {
    public function create() { 
         require_once '../template/serviceCommercial/admin.html.php';
    }

  

    public function store() {  
        require_once '../template/serviceCommercial/loginAdmin.html.php';
        
        
     
    }
    public function edit() {
       
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


}