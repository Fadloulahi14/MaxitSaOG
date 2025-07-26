<?php

namespace App\core;
require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../'); // ou adapte le chemin selon ta structure
$dotenv->load();

use PDO;
use PDOException;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../'); // ou adapte le chemin selon ta structure
$dotenv->load();

class Database
{
    private ?PDO $pdo = null;
    private static ?Database $instance = null;

    private function __construct()
    {
        
// DB_HOST=127.0.0.1
// DB_PORT=3306
// DB_NAME=GesAushan
// DB_USER=gesaushan_user
// DB_PASSWORD=gesaushan_password
        $driver=$_ENV['DB_DRIVER'];
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        $dns = "$driver:host=$host; dbname=$dbname;port=$port";


        try {
            $this->pdo = new PDO($dns,  $user, $password); 
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connexion réussie à la base de données.\n";
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        if (self::$instance->pdo === null) {
            throw new \RuntimeException("La connexion PDO a échoué.");
        }

        return self::$instance->pdo;
    }


    public static function disconnect(): void
    {
        self::$instance = null;
    }
}
