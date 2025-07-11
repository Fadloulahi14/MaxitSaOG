<?php
namespace App\core;
class Routeur{
   
    public static function resolve(array $route){

 
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    $Uris = trim($requestUri, '/');
    //     if (empty($Uris)) {
    //     $controller = new CommandeController();
    //     $controller->store();
    //     return;
    // }
 
    // var_dump($route[$Uris]);
    // die;





  
    if (isset($route[$Uris])) {
        
        $route = $route[$Uris];
        $controllerClass = $route['controller'];

        $method = $route['method'];
        $controller = new $controllerClass();
        $controller->$method();
    } else {
       echo "404 Not Found";
    }


    
    }


}


