<?php
namespace App\Controller;
use App\core\AbstractController;

use App\core\Session;

use App\Repository\TransactionRepository;
use App\core\App;


 class CniControlle extends AbstractController {
    public function create() { 
         $this -> renderIndex('views/acceuil.html.php');
    }

  

    public function store() {  
        
    }
    public function edit() {

    }
    public function show(){
    }
    public function delete() {
    }
    public function index(){
      
    }

    public function cni() {
       
        //  $this->renderIndex('views/cni.html.php');
        require_once '../template/login/cni.html.php';
    }

   
}