<?php
namespace App\core;

class App
{
   private $instance = null; 
   private static $dependencies = [];

   public static function loadDependencies() {
       $servicesFile = __DIR__ . '/../service.yml';
       
       $yamlContent = file_get_contents($servicesFile);
       $services = self::parseYaml($yamlContent);
       
       if (isset($services['services'])) {
           self::$dependencies = $services['services'];
       }
   }
   
   private static function parseYaml($yamlContent) {
       $lines = explode("\n", $yamlContent);
       $result = [];
       $currentSection = null;
       
       foreach ($lines as $line) {
           $line = trim($line);
           
           if (empty($line) || strpos($line, '#') === 0) {
               continue;
           }
           
           if (strpos($line, ':') !== false) {
               $parts = explode(':', $line, 2);
               $key = trim($parts[0]);
               $value = trim($parts[1]);
               
               if ($value === '') {
                   $currentSection = $key;
                   $result[$currentSection] = [];
               } else {
                   if ($currentSection) {
                       $result[$currentSection][$key] = $value;
                   } else {
                       $result[$key] = $value;
                   }
               }
           }
       }
       
       return $result;
   }
   
   public static function getDependency($key){
       if (empty(self::$dependencies)) {
           self::loadDependencies();
       }
       
       if(array_key_exists($key, self::$dependencies)){
           $class = self::$dependencies[$key];
           
           if(class_exists($class) && method_exists($class, 'getInstance')){
               return $class::getInstance();
           }
           return new $class();
       }
       throw new \Exception("Dépendance '$key' introuvable");
   }
}
