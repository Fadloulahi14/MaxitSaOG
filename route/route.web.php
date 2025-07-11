<?php
use App\Controller\Accueilontroller;
use App\Controller\ControllerSeuriter;
use App\core\Middleware; 

$uris = [
    "" => ['controller' => ControllerSeuriter::class, 'method' => 'store'],
    'login' => ['controller' => ControllerSeuriter::class, 'method' => 'login'],
    'inscription' => ['controller' => ControllerSeuriter::class, 'method' => 'inscription'],
    'create' => ['controller' => ControllerSeuriter::class, 'method' => 'create'],
    'store' => ['controller' => ControllerSeuriter::class, 'method' => 'index', 'middleware' => 'auth'],
    'logout' => ['controller' => ControllerSeuriter::class, 'method' => 'logout'],
];
