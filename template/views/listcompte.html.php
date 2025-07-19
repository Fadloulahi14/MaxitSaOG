    <div class="container mx-auto px-4 py-8">
        <!-- Messages de succès/erreur -->
        <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <strong>Succès !</strong> Le compte a été défini comme compte principal.
            </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error']) && $_GET['error'] == '1'): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <strong>Erreur !</strong> Impossible de définir ce compte comme principal.
            </div>
        <?php endif; ?>

        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Mes Comptes Secondaires</h1>
            <p class="text-gray-600 text-lg">Tous vos comptes secondaires et leurs soldes</p>
        </div>

        <!-- Accounts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <?php if (!empty($comptes_secondaires)): ?>
                <?php foreach ($comptes_secondaires as $index => $compte): ?>
                    <div class="bg-white border-2 border-orange-200 rounded-2xl p-6 hover:border-orange-500 cursor-pointer transform hover:-translate-y-1 transition-all duration-300 shadow-sm hover:shadow-lg">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 <?= $index % 6 == 0 ? 'bg-orange-100' : ($index % 6 == 1 ? 'bg-blue-100' : ($index % 6 == 2 ? 'bg-purple-100' : ($index % 6 == 3 ? 'bg-indigo-100' : ($index % 6 == 4 ? 'bg-red-100' : 'bg-yellow-100')))) ?> rounded-xl flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 <?= $index % 6 == 0 ? 'text-orange-600' : ($index % 6 == 1 ? 'text-blue-600' : ($index % 6 == 2 ? 'text-purple-600' : ($index % 6 == 3 ? 'text-indigo-600' : ($index % 6 == 4 ? 'text-red-600' : 'text-yellow-600')))) ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-700 text-lg">Compte Secondaire <?= $index + 1 ?></h3>
                                    <p class="text-gray-500 text-sm">Mobile Money</p>
                                    <p class="text-gray-400 text-xs font-mono"><?= htmlspecialchars($compte['telephone']) ?></p>
                                </div>
                            </div>
                            <span class="inline-block px-3 py-1 <?= $compte['statut'] == 'Actif' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' ?> rounded-full text-sm font-medium">
                                <?= htmlspecialchars($compte['statut']) ?>
                            </span>
                        </div>
                        <div class="mb-4">
                            <div class="text-gray-500 text-sm mb-1">Solde disponible</div>
                            <div class="font-bold text-2xl text-green-600"><?= htmlspecialchars($compte['solde']) ?> F</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-gray-500 text-sm">
                                Dernière mise à jour: <?= date('d/m/Y H:i', strtotime($compte['date_creation'])) ?>
                            </div>
                        </div>
                        
                        <!-- Formulaire pour définir comme compte principal -->
                        <div class="mt-4">
                            <form method="POST" action="definir-principal">
                                <input type="hidden" name="compte_id" value="<?= $compte['id'] ?>">
                                <button 
                                    type="submit"
                                    class="w-full bg-green-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-600 transition-colors duration-200 flex items-center justify-center gap-2"
                                   
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Définir comme compte principal
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Message si aucun compte secondaire -->
                <div class="col-span-full text-center py-12">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Aucun compte secondaire</h3>
                    <p class="text-gray-500 mb-6">Vous n'avez pas encore créé de compte secondaire</p>
                    <a href="/compte-secondaire/create" class="bg-orange-400 text-white px-8 py-3 rounded-full font-semibold hover:bg-orange-500 transition-colors">
                        Créer votre premier compte
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($comptes_secondaires)): ?>
            <!-- Summary Card -->
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl p-8 text-white mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">Total Comptes Secondaires</h2>
                        <div class="text-4xl font-bold"><?= htmlspecialchars($total_solde) ?> F</div>
                        <p class="text-orange-100 mt-2">Répartition sur <?= $nombre_comptes ?> compte<?= $nombre_comptes > 1 ? 's' : '' ?> secondaire<?= $nombre_comptes > 1 ? 's' : '' ?></p>
                    </div>
                    <div class="text-right">
                        <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="/compte-secondaire/create" class="bg-orange-400 text-white px-8 py-4 rounded-full font-semibold hover:bg-orange-500 transition-colors">
                    Ajouter un compte secondaire
                </a>
                <button class="bg-white border-2 border-orange-400 text-orange-600 px-8 py-4 rounded-full font-semibold hover:bg-orange-50 transition-colors">
                    Voir les détails
                </button>
                <button class="bg-white border-2 border-gray-300 text-gray-600 px-8 py-4 rounded-full font-semibold hover:bg-gray-50 transition-colors">
                    Exporter les données
                </button>
            </div>
        <?php endif; ?>
    </div>
