
    
    <!-- Container Principal -->
    <div class="w-full bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- En-tête -->
            <div class="mb-10">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-user-plus text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Ajouter un Compte Secondaire</h1>
                        <p class="text-lg text-gray-600 mt-1">Créez un nouveau compte associé à votre compte principal</p>
                    </div>
                </div>
            </div>

            <!-- Messages d'erreur/succès -->
            <?php if (isset($error['global'])): ?>
                <div class="bg-red-50 border-l-4 border-red-400 p-6 mb-8 rounded-r-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 text-xl mr-4"></i>
                        <p class="text-red-700 text-lg font-medium"><?= htmlspecialchars($error['global']) ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
                <div class="bg-green-50 border-l-4 border-green-400 p-6 mb-8 rounded-r-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-4"></i>
                        <p class="text-green-700 text-lg font-medium"><?= htmlspecialchars($success) ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Formulaire -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                <div class="px-8 py-10">
                    <form method="POST" action="/secondaire" class="space-y-10">
                        
                        <!-- Section Informations du compte -->
                        <div class="space-y-8">
                            <div class="border-b border-gray-200 pb-6">
                                <h2 class="text-xl font-semibold text-gray-900 mb-2">Informations du compte</h2>
                                <p class="text-gray-600">Saisissez les détails du nouveau compte secondaire</p>
                            </div>

                            <!-- Champ Téléphone -->
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                                <div class="lg:col-span-1">
                                    <label for="telephone" class="flex items-center text-lg font-semibold text-gray-900 mb-2">
                                        <i class="fas fa-phone text-orange-500 mr-3"></i>
                                        Numéro de téléphone
                                        <span class="text-red-500 ml-2">*</span>
                                    </label>
                                    <p class="text-sm text-gray-600">Le numéro qui sera associé au compte secondaire</p>
                                </div>
                                
                                <div class="lg:col-span-2">
                                    <div class="relative">
                                        <input 
                                            type="tel" 
                                            id="telephone" 
                                            name="telephone" 
                                            class="w-full px-6 py-4 border-2 <?= isset($error['telephone']) ? 'border-red-300 focus:border-red-500' : 'border-gray-300 focus:border-orange-500' ?> rounded-lg outline-none text-lg text-gray-900 bg-white focus:bg-gray-50 placeholder-gray-500"
                                            placeholder="Exemple: 778012345"
                                            value="<?= htmlspecialchars($donnees['telephone'] ?? '') ?>"
                                            required
                                        >
                                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                            <i class="fas fa-mobile-alt text-xl"></i>
                                        </div>
                                    </div>
                                    <?php if (isset($error['telephone'])): ?>
                                        <div class="flex items-center mt-3 text-red-600">
                                            <i class="fas fa-times-circle mr-2"></i>
                                            <span class="text-sm font-medium"><?= htmlspecialchars($error['telephone']) ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="mt-3 flex items-center text-sm text-gray-600">
                                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                        Entrez un numéro de 9 chiffres (sans indicatif pays)
                                    </div>
                                </div>
                            </div>

                            <!-- Champ Solde -->
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                                <div class="lg:col-span-1">
                                    <label for="solde" class="flex items-center text-lg font-semibold text-gray-900 mb-2">
                                        <i class="fas fa-wallet text-orange-500 mr-3"></i>
                                        Solde initial
                                        <span class="text-gray-500 text-base ml-2 font-normal">(optionnel)</span>
                                    </label>
                                    <p class="text-sm text-gray-600">Montant à transférer vers le nouveau compte</p>
                                </div>
                                
                                <div class="lg:col-span-2">
                                    <div class="relative">
                                        <input 
                                            type="number" 
                                            id="solde" 
                                            name="solde" 
                                            min="0"
                                            step="1"
                                            class="w-full px-6 py-4 border-2 <?= isset($error['solde']) ? 'border-red-300 focus:border-red-500' : 'border-gray-300 focus:border-orange-500' ?> rounded-lg outline-none text-lg text-gray-900 bg-white focus:bg-gray-50 placeholder-gray-500"
                                            placeholder="Exemple: 10000"
                                            value="<?= htmlspecialchars($donnees['solde'] ?? '') ?>"
                                        >
                                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-600">
                                            <span class="font-semibold">FCFA</span>
                                        </div>
                                    </div>
                                    <?php if (isset($error['solde'])): ?>
                                        <div class="flex items-center mt-3 text-red-600">
                                            <i class="fas fa-times-circle mr-2"></i>
                                            <span class="text-sm font-medium"><?= htmlspecialchars($error['solde']) ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Info solde -->
                                    <div class="mt-4 p-5 bg-blue-50 border border-blue-200 rounded-lg">
                                        <div class="flex items-start space-x-3">
                                            <i class="fas fa-info-circle text-blue-500 text-lg mt-1"></i>
                                            <div class="flex-1">
                                                <p class="text-sm text-gray-700 mb-3">Ce montant sera débité de votre compte principal et transféré vers le nouveau compte secondaire.</p>
                                                <div class="flex items-center justify-between bg-white p-3 rounded border border-blue-200">
                                                    <span class="text-sm font-medium text-gray-700">Votre solde actuel :</span>
                                                    <div class="flex items-center space-x-1">
                                                        <span class="text-xl font-bold text-green-600"><?= number_format($solde ?? 0, 0, ',', ' ') ?></span>
                                                        <span class="text-sm text-gray-600">FCFA</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="border-t border-gray-200 pt-8">
                            <div class="flex flex-col sm:flex-row gap-4 sm:justify-between sm:items-center">
                                <div class="order-2 sm:order-1">
                                    <a href="/store" class="inline-flex items-center px-6 py-3 text-gray-700 hover:text-gray-900 font-medium rounded-lg hover:bg-gray-100 border border-gray-300">
                                        <i class="fas fa-arrow-left mr-2"></i>
                                        Retour à l'accueil
                                    </a>
                                </div>
                                
                                <div class="order-1 sm:order-2">
                                    <button 
                                        type="submit" 
                                        class="w-full sm:w-auto bg-orange-500 hover:bg-orange-600 text-white px-10 py-4 rounded-lg font-semibold text-lg shadow-md hover:shadow-lg border border-orange-500 flex items-center justify-center space-x-3"
                                    >
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Créer le compte secondaire</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

