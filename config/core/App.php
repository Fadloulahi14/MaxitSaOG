<?php
namespace App\core;
use App\Controller\AdminController;
use App\core\Database;

use App\core\Routeur;
use App\Repository\AcceuilRepository;
use App\Repository\CompteRepository;
use App\Repository\PersonneRepository;
use App\Repository\TransactionRepository;


 class App
{
   private $instance = null; 

   private static $dependencies = [
    'database'=>Database::class,
    'acceuilRepository'=> AcceuilRepository::class,
    'compteRepository'=>CompteRepository::class,
    'personneRepository'=>PersonneRepository::class,
    'transactionRepository'=>TransactionRepository::class,
    'routeur'=>Routeur::class,
    'session'=>Session::class,
    'acceuilController'=>AcceuilController::class,
    'adminController'=>AdminController::class,
    'validator'=>Validator::class,

   ];

   
   public static function getDependency($key){
        if(array_key_exists($key, self::$dependencies)){
            $class = self::$dependencies[$key];
            
            if(class_exists($class) && method_exists($class, 'getInstance')){
                return $class::getInstance();
            }
            return new $class();
        }
        throw new \Exception("dialloul");
    }
} 