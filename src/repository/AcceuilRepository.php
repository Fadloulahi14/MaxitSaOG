<?php
namespace App\Repository;
use App\core\Database;
use PDO;
use App\core\App;

class AcceuilRepository{
    private PDO $pdo;
    public function __construct(){
        $this ->pdo = App::getDependency('database');

    }


}