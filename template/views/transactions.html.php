<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Toutes mes transactions</h1>
    
    <!-- Formulaire de recherche -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form method="GET" action="/transactions" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Filtrer par date</label>
                <input type="date" id="date" name="date" 
                       value="<?= htmlspecialchars($_GET['date'] ?? '') ?>"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>
            
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type de transaction</label>
                <select id="type" name="type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="">Tous les types</option>
                    <option value="TRANSFERT_DEPOT" <?= ($_GET['type'] ?? '') === 'TRANSFERT_DEPOT' ? 'selected' : '' ?>>Dépôt</option>
                    <option value="TRANSFERT_RETRAIT" <?= ($_GET['type'] ?? '') === 'TRANSFERT_RETRAIT' ? 'selected' : '' ?>>Retrait</option>
                    <option value="PAIEMENT" <?= ($_GET['type'] ?? '') === 'PAIEMENT' ? 'selected' : '' ?>>Paiement</option>
                </select>
            </div>
            
            <div class="md:col-span-2 flex gap-4">
                <button type="submit" class="bg-orange-400 text-white px-6 py-2 rounded-md hover:bg-orange-500 transition-colors">
                    Rechercher
                </button>
                <a href="/transactions" class="bg-gray-400 text-white px-6 py-2 rounded-md hover:bg-gray-500 transition-colors">
                    Réinitialiser
                </a>
            </div>
        </form>
    </div>
    
    <!-- Affichage des critères de recherche actifs -->
    <?php if (!empty($_GET['date']) || !empty($_GET['type'])): ?>
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <h3 class="text-sm font-medium text-blue-800 mb-2">Filtres actifs :</h3>
            <div class="flex flex-wrap gap-2">
                <?php if (!empty($_GET['date'])): ?>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        Date : <?= htmlspecialchars($_GET['date']) ?>
                    </span>
                <?php endif; ?>
                <?php if (!empty($_GET['type'])): ?>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        Type : <?= htmlspecialchars($_GET['type']) ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- Liste des transactions -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <?php if (!empty($transactions)): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($transactions as $transaction): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= date('d/m/Y H:i', strtotime($transaction['date'])) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        <?= htmlspecialchars($transaction['type']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium <?= $transaction['montant'] < 0 ? 'text-red-600' : 'text-green-600' ?>">
                                    <?= number_format($transaction['montant'], 0, ',', ' ') ?> F
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Terminé
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Nombre de résultats -->
            <div class="bg-gray-50 px-6 py-3">
                <p class="text-sm text-gray-700">
                    <?= count($transactions) ?> transaction(s) trouvée(s)
                </p>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Aucune transaction trouvée pour les critères sélectionnés.</p>
                <?php if (!empty($_GET['date']) || !empty($_GET['type'])): ?>
                    <p class="text-gray-400 text-sm mt-2">Essayez de modifier vos critères de recherche.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="mt-8 text-center">
        <a href="/store" class="bg-gray-400 text-white px-6 py-2 rounded-md hover:bg-gray-500 transition-colors">
            Retour à l'accueil
        </a>
    </div>
</div>