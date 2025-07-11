<?php

echo "=== TEST MULTIPLE CONFIGURATIONS ===\n\n";

$configurations = [
    [
        'name' => 'Config 1: root avec mot de passe vide',
        'host' => 'localhost',
        'port' => '3306',
        'username' => 'root',
        'password' => '',
        'dbname' => 'GesAushan'
    ],
    [
        'name' => 'Config 2: root avec mot de passe "root"',
        'host' => 'localhost',
        'port' => '3306',
        'username' => 'root',
        'password' => 'root',
        'dbname' => 'GesAushan'
    ],
    [
        'name' => 'Config 3: root@127.0.0.1 mot de passe vide',
        'host' => '127.0.0.1',
        'port' => '3306',
        'username' => 'root',
        'password' => '',
        'dbname' => 'GesAushan'
    ],
    [
        'name' => 'Config 4: gesaushan_user@localhost',
        'host' => 'localhost',
        'port' => '3306',
        'username' => 'gesaushan_user',
        'password' => 'gesaushan_password',
        'dbname' => 'GesAushan'
    ],
    [
        'name' => 'Config 5: gesaushan_user@127.0.0.1',
        'host' => '127.0.0.1',
        'port' => '3306',
        'username' => 'gesaushan_user',
        'password' => 'gesaushan_password',
        'dbname' => 'GesAushan'
    ]
];

$workingConfig = null;

foreach ($configurations as $config) {
    echo "Test: {$config['name']}\n";
    echo "DSN: mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}\n";
    
    try {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8mb4";
        $pdo = new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        
        // Test simple
        $stmt = $pdo->query('SELECT 1 as test');
        $result = $stmt->fetch();
        
        if ($result['test'] == 1) {
            echo "✅ CONNEXION RÉUSSIE!\n";
            $workingConfig = $config;
            
            // Test d'accès aux tables
            try {
                $stmt = $pdo->query('SHOW TABLES');
                $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
                echo "✅ Tables trouvées: " . count($tables) . "\n";
                foreach ($tables as $table) {
                    echo "  - {$table}\n";
                }
            } catch (PDOException $e) {
                echo "⚠️ Erreur d'accès aux tables: " . $e->getMessage() . "\n";
            }
            
            break;
        }
        
    } catch (PDOException $e) {
        echo "❌ Échec: " . $e->getMessage() . "\n";
    }
    
    echo str_repeat("-", 60) . "\n\n";
}

if ($workingConfig) {
    echo "\n🎉 CONFIGURATION FONCTIONNELLE TROUVÉE!\n";
    echo "--- Copiez cette configuration dans Database.php ---\n";
    echo "private array \$config = [\n";
    echo "    'host' => '{$workingConfig['host']}',\n";
    echo "    'port' => '{$workingConfig['port']}',\n";
    echo "    'dbname' => '{$workingConfig['dbname']}',\n";
    echo "    'username' => '{$workingConfig['username']}',\n";
    echo "    'password' => '{$workingConfig['password']}',\n";
    echo "    'charset' => 'utf8mb4',\n";
    echo "    'options' => [\n";
    echo "        \\PDO::ATTR_ERRMODE => \\PDO::ERRMODE_EXCEPTION,\n";
    echo "        \\PDO::ATTR_DEFAULT_FETCH_MODE => \\PDO::FETCH_ASSOC,\n";
    echo "        \\PDO::ATTR_EMULATE_PREPARES => false,\n";
    echo "    ]\n";
    echo "];\n";
    echo "--- Fin configuration ---\n";
} else {
    echo "\n❌ AUCUNE CONFIGURATION FONCTIONNELLE TROUVÉE\n";
    echo "Vérifiez que MySQL est démarré et que la base GesAushan existe.\n";
}