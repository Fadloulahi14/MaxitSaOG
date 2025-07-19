<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


try {
    $dsn = $_ENV['dns'] ?? "{$_ENV['DB_DRIVER']}:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']}";
    $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données\n";
} catch (PDOException $e) {
    die(" Connexion échouée : " . $e->getMessage());
}

try {
    $pdo->beginTransaction();

    // 1. Clients
    $clients = [
        ['Fallou', 'Ndiaye', 'Dakar Liberté 6', '770000001'],
        ['Ousmane', 'Marra', 'Dakar Médina', '770000002'],
        ['Astou', 'Mbow', 'Rufisque', '770000003'],
        ['Thierno', 'Sagnane', 'Ziguinchor', '770000004'],
        ['Bamba', 'Thiam', 'Kaolack', '770000005'],
        ['Faby', 'Sow', 'Touba', '770000006']
    ];
    $stmtClient = $pdo->prepare("INSERT INTO client (nom, prenom, adresse, telephone) VALUES (?, ?, ?, ?)");
    $clientIds = [];
    foreach ($clients as $client) {
        $stmtClient->execute($client);
        $clientIds[] = $pdo->lastInsertId();
    }
    echo "Clients insérés\n";

    // 2. Comptes
    $comptes = [
        ['770000001', 'CNI001', 'recto1.png', 'verso1.png', 150000, true, $clientIds[0]],
        ['770000002', 'CNI002', 'recto2.png', 'verso2.png', 120000, true, $clientIds[1]],
        ['770000003', 'CNI003', 'recto3.png', 'verso3.png', 20000, true, $clientIds[2]],
        ['770000004', 'CNI004', 'recto4.png', 'verso4.png', 80000, true, $clientIds[3]],
        ['770000005', 'CNI005', 'recto5.png', 'verso5.png', 30000, true, $clientIds[4]],
        ['770000006', 'CNI006', 'recto6.png', 'verso6.png', 100000, true, $clientIds[5]],
    ];
    $stmtCompte = $pdo->prepare("INSERT INTO compte (numerotelephone, numerocni, photorecto, photoverso, solde, estprincipale, id_client) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $compteIds = [];
    foreach ($comptes as $compte) {
        $stmtCompte->execute($compte);
        $compteIds[] = $pdo->lastInsertId();
    }
    echo "Comptes insérés\n";

    // 3. Service Commercial
    $stmtSC = $pdo->prepare("INSERT INTO servicecommercial (login, motdepasse) VALUES (?, ?)");
    $stmtSC->execute(['admin@maxitsa.sn', password_hash('passer123', PASSWORD_BCRYPT)]);
    echo "Service commercial inséré\n";

    // 4. Transactions
    $transactions = [
        ['2025-07-18 12:00:00', 10000, $compteIds[0], $compteIds[1], 'transfert', $compteIds[0]],
        ['2025-07-18 14:00:00', 5000, null, null, 'retrait', $compteIds[1]],
        ['2025-07-18 15:00:00', 20000, null, null, 'depot', $compteIds[2]],
        ['2025-07-18 16:00:00', 15000, $compteIds[3], $compteIds[4], 'transfert', $compteIds[3]],
        ['2025-07-18 17:00:00', 10000, null, null, 'retrait', $compteIds[5]],
    ];
    $stmtTrx = $pdo->prepare("INSERT INTO transaction (date, montant, numcomptedepot, numcomptedestinataire, type, id_compte) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($transactions as $trx) {
        $stmtTrx->execute($trx);
    }
    echo "Transactions insérées\n";

    // Fin de transaction
    $pdo->commit();
    echo " Toutes les données ont été insérées avec succès dans une transaction.\n";

} catch (PDOException $e) {
    $pdo->rollBack();
    die("Erreur lors de l'insertion des données : " . $e->getMessage());
}
