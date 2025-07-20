<?php
namespace App\Controller;
use App\core\AbstractController;

use App\core\Session;



 class TransfertController extends AbstractController {
    public function create() { 
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

    public function transfert() {

          $session = Session::getInstance();
        
        $client = $session->get('Client');
        
        if (!$client) {
            header('Location: /');
            exit();
        }
        $this->renderIndex('views/transfert.html.php',[
                        'numero' => $client['numerotelephone'] ?? $client['telephone'] ?? '',
                        'solde' => $client['solde']
                    ]);
    }


}