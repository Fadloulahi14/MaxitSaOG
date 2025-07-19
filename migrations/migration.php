<?php

require_once __DIR__ . '/../vendor/autoload.php';

function prompt(string $message): string {
    echo $message;
    return trim(fgets(STDIN));
}

function writeEnvIfNotExists(array $config): void {
    $envPath = __DIR__ . '/../.env';
    if (!file_exists($envPath)) {
        $env = <<<ENV
DB_DRIVER={$config['driver']}
DB_HOST={$config['host']}
DB_PORT={$config['port']}
DB_NAME={$config['dbname']}
DB_USER={$config['user']}
DB_PASSWORD={$config['pass']}
ROUTE_WEB=http://localhost:8000/

dns = "{$config['driver']}:host={$config['host']}; dbname={$config['dbname']};port={$config['port']}"

# Configuration Twilio
TWILIO_ACCOUNT_SID=AC59a58465f63dc0b3fe65120c7bab543a
TWILIO_AUTH_TOKEN=7115a7015ed080ecfbbf3489d721290e
TWILIO_PHONE_NUMBER=+15705690981
ENV;
        file_put_contents($envPath, $env);
        echo ".env généré avec succès à la racine du projet.\n";
    } else {
        echo "Le fichier .env existe déjà, aucune modification.\n";
    }
}

$driver = strtolower(prompt("Quel SGBD utiliser ? (mysql / pgsql) : "));
$host = prompt("Hôte (default: 127.0.0.1) : ") ?: "127.0.0.1";
$port = prompt("Port (default: 3306 ou 5432) : ") ?: ($driver === 'pgsql' ? "5432" : "3306");
$user = prompt("Utilisateur (default: root) : ") ?: "root";
$pass = prompt("Mot de passe : ");
$dbName = prompt("Nom de la base à créer : ");

try {
    $dsn = "$driver:host=$host;port=$port";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($driver === 'mysql') {
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "Base MySQL `$dbName` créée avec succès.\n";
        $pdo->exec("USE `$dbName`");
    } elseif ($driver === 'pgsql') {
        $check = $pdo->query("SELECT 1 FROM pg_database WHERE datname = '$dbName'")->fetch();
        if (!$check) {
            $pdo->exec("CREATE DATABASE \"$dbName\"");
            echo "Base PostgreSQL `$dbName` créée.\nRelancez la migration pour créer les tables.\n";
               writeEnvIfNotExists([
                'driver' => $driver,
                'host' => $host,
                'port' => $port,
                'user' => $user,
                'pass' => $pass,
                'dbname' => $dbName
            ]);
            exit;
        } else {
            echo "ℹ Base PostgreSQL `$dbName` déjà existante.\n";
        }
    }

    $dsn = "$driver:host=$host;port=$port;dbname=$dbName";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($driver === 'mysql') {
        $tables = [
            "CREATE TABLE IF NOT EXISTS client (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                nom VARCHAR(100) NOT NULL,
                prenom VARCHAR(100) NOT NULL,
                adresse VARCHAR(255),
                telephone VARCHAR(20)
            );",
            "CREATE TABLE IF NOT EXISTS compte (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                numerotelephone VARCHAR(20) UNIQUE NOT NULL,
                numerocni VARCHAR(20),
                photorecto VARCHAR(255),
                photoverso VARCHAR(255),
                solde DOUBLE PRECISION DEFAULT 0,
                estprincipale BOOLEAN DEFAULT false,
                id_client INT UNSIGNED NOT NULL,
                FOREIGN KEY (id_client) REFERENCES client(id) ON DELETE CASCADE
            );",
            "CREATE TABLE IF NOT EXISTS servicecommercial (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                login VARCHAR(100) UNIQUE NOT NULL,
                motdepasse VARCHAR(255) NOT NULL
            );",
            "CREATE TABLE IF NOT EXISTS transaction (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                montant DOUBLE PRECISION NOT NULL,
                numcomptedepot INT UNSIGNED,
                numcomptedestinataire INT UNSIGNED,
                type ENUM('depot', 'retrait', 'transfert') NOT NULL,
                id_compte INT UNSIGNED NOT NULL,
                FOREIGN KEY (id_compte) REFERENCES compte(id) ON DELETE CASCADE,
                FOREIGN KEY (numcomptedepot) REFERENCES compte(id),
                FOREIGN KEY (numcomptedestinataire) REFERENCES compte(id)
            );"
        ];
    } else {
        $pdo->exec("DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'transaction_type') THEN
                CREATE TYPE transaction_type AS ENUM ('depot', 'retrait', 'transfert');
            END IF;
        END$$;");

        $tables = [
            "CREATE TABLE IF NOT EXISTS client (
                id SERIAL PRIMARY KEY,
                nom VARCHAR(100) NOT NULL,
                prenom VARCHAR(100) NOT NULL,
                adresse VARCHAR(255),
                telephone VARCHAR(20)
            );",
            "CREATE TABLE IF NOT EXISTS compte (
                id SERIAL PRIMARY KEY,
                numerotelephone VARCHAR(20) UNIQUE NOT NULL,
                numerocni VARCHAR(20),
                photorecto VARCHAR(255),
                photoverso VARCHAR(255),
                solde DOUBLE PRECISION DEFAULT 0,
                estprincipale BOOLEAN DEFAULT false,
                id_client INTEGER NOT NULL,
                FOREIGN KEY (id_client) REFERENCES client(id) ON DELETE CASCADE
            );",
            "CREATE TABLE IF NOT EXISTS servicecommercial (
                id SERIAL PRIMARY KEY,
                login VARCHAR(100) UNIQUE NOT NULL,
                motdepasse VARCHAR(255) NOT NULL
            );",
            "CREATE TABLE IF NOT EXISTS transaction (
                id SERIAL PRIMARY KEY,
                date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                montant DOUBLE PRECISION NOT NULL,
                numcomptedepot INTEGER,
                numcomptedestinataire INTEGER,
                type transaction_type NOT NULL,
                id_compte INTEGER NOT NULL,
                FOREIGN KEY (id_compte) REFERENCES compte(id) ON DELETE CASCADE,
                FOREIGN KEY (numcomptedepot) REFERENCES compte(id),
                FOREIGN KEY (numcomptedestinataire) REFERENCES compte(id)
            );"
        ];
    }

    foreach ($tables as $sql) {
        $pdo->exec($sql);
    }

    echo "Toutes les tables ont été créées avec succès dans `$dbName`.\n";
    writeEnvIfNotExists([
    'driver' => $driver,
    'host' => $host,
    'port' => $port,
    'user' => $user,
    'pass' => $pass,
    'dbname' => $dbName
]);


} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}