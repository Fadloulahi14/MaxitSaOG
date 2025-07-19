<?php
use App\Controller\Accueilontroller;
use App\Controller\ControllerSeuriter;
use App\Controller\CompteSecondaireController;
use App\Controller\AdminController;


$uris = [
    "" => [
        'controller' => ControllerSeuriter::class,
        'method' => 'store'
    ],
    'login' =>[
        'controller' => ControllerSeuriter::class, 
        'method' => 'login'
    ],
    'inscription' => [
        'controller' => ControllerSeuriter::class,
         'method' => 'inscription',
         'middleware' => 'auth'
        ],
    'create' => [
        'controller' => ControllerSeuriter::class,
         'method' => 'create',
        //  'middleware' => 'auth'
        ],
    'secondaire' => [
        'controller' => CompteSecondaireController::class,
         'method' => 'create',
         'middleware' => 'auth'
        ],
    'store' => [
        'controller' => Accueilontroller::class, 
        'method' => 'edit',
        'middleware' => 'auth'
    ],
    'stor' => [
        'controller' => CompteSecondaireController::class, 
        'method' => 'edit',

        'middleware' => 'auth'
    ],
       'list' => [
        'controller' => CompteSecondaireController::class, 
        'method' => 'liste',

        'middleware' => 'auth'
    ],
       'definir-principal' => [
        'controller' => CompteSecondaireController::class, 
        'method' => 'definirPrincipal',

        'middleware' => 'auth'
    ],
    'transactions' => [
        'controller' => Accueilontroller::class, 
        'method' => 'transactions',
        
    ],
    'logout' => [
        'controller' => ControllerSeuriter::class, 
        'method' => 'logout'
    ],
    'admin' => [
        'controller' => AdminController::class,
         'method' => 'create'
        ],
    'loginAdmin' => [
        'controller' => AdminController::class,
         'method' => 'store'
        ],





];
