<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfert d'Argent - Mobile Money</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen overflow-hidden">
    <!-- Container Principal -->
    <div class="h-screen w-full p-2">
        <div class="w-full h-full">
            <!-- Formulaire Principal -->
            <form class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden h-full flex flex-col">
                <!-- En-tête du formulaire -->
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-4 py-3 flex-shrink-0">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-bold text-white">Nouveau Transfert</h2>
                            <p class="text-orange-100 text-xs">Remplissez les informations</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-1.5">
                            <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Corps du formulaire -->
                <div class="flex-1 px-6 py-3 space-y-4">
                    
                    <!-- Section Destinataire -->
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 bg-orange-100 rounded-lg flex items-center justify-center">
                                <svg class="w-3 h-3 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-gray-800">Destinataire</h3>
                        </div>

                        <!-- Numéro de téléphone -->
                        <div class="space-y-1">
                            <label for="numero" class="block text-xs font-semibold text-gray-700">
                                Numéro de téléphone
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                    <span class="text-gray-600 font-semibold text-xs">+221</span>
                                </div>
                                <input type="tel" 
                                       id="numero" 
                                       name="numero" 
                                       class="w-full pl-12 pr-3 py-2 border border-gray-200 rounded-lg outline-none focus:border-orange-500 transition-all bg-gray-50 focus:bg-white text-sm font-semibold" 
                                       placeholder="77 123 45 67">
                            </div>
                        </div>
                    </div>

                    <!-- Séparateur -->
                    <div class="flex items-center">
                        <div class="flex-1 border-t border-gray-200"></div>
                        <div class="px-2 py-1 bg-orange-50 rounded-full">
                            <svg class="w-3 h-3 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M7 17l9.2-9.2M17 17H7v-10"></path>
                            </svg>
                        </div>
                        <div class="flex-1 border-t border-gray-200"></div>
                    </div>

                    <!-- Section Montant -->
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-3 h-3 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-gray-800">Montant</h3>
                        </div>

                        <!-- Montant à envoyer -->
                        <div class="space-y-1">
                            <label for="montant" class="block text-xs font-semibold text-gray-700">
                                Montant à envoyer
                            </label>
                            <div class="relative">
                                <input type="number" 
                                       id="montant" 
                                       name="montant" 
                                       min="100" 
                                       step="50"
                                       class="w-full pl-3 pr-14 py-2 border border-gray-200 rounded-lg outline-none focus:border-orange-500 transition-all bg-gray-50 focus:bg-white text-sm font-semibold text-center" 
                                       placeholder="0">
                                <div class="absolute inset-y-0 right-0 pr-2 flex items-center">
                                    <span class="text-gray-600 font-bold text-xs">F CFA</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center text-xs text-gray-500">
                                <span>Min: 100 F CFA</span>
                                <span class="text-orange-600 font-semibold">Frais: 0 F CFA</span>
                            </div>
                        </div>

                        <!-- Montants rapides -->
                        <div class="space-y-1">
                            <label class="block text-xs font-semibold text-gray-700">Montants rapides</label>
                            <div class="grid grid-cols-4 gap-1">
                                <button type="button" class="px-2 py-2 bg-orange-50 text-orange-700 rounded-lg text-xs font-semibold hover:bg-orange-100 transition-colors border border-orange-100">
                                    1K
                                </button>
                                <button type="button" class="px-2 py-2 bg-orange-50 text-orange-700 rounded-lg text-xs font-semibold hover:bg-orange-100 transition-colors border border-orange-100">
                                    5K
                                </button>
                                <button type="button" class="px-2 py-2 bg-orange-50 text-orange-700 rounded-lg text-xs font-semibold hover:bg-orange-100 transition-colors border border-orange-100">
                                    10K
                                </button>
                                <button type="button" class="px-2 py-2 bg-orange-50 text-orange-700 rounded-lg text-xs font-semibold hover:bg-orange-100 transition-colors border border-orange-100">
                                    25K
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Note importante -->
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-3 rounded-r-lg">
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-blue-500 mt-0.5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 16v-4"></path>
                                <path d="M12 8h.01"></path>
                            </svg>
                            <div>
                                <h4 class="text-blue-800 font-semibold text-xs mb-1">Information</h4>
                                <p class="text-blue-700 text-xs leading-tight">
                                    Transfert possible entre comptes principal/secondaire ou entre deux comptes principaux.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pied du formulaire -->
                <div class="bg-gray-50 px-4 py-3 border-t border-gray-100 flex-shrink-0">
                    <div class="flex gap-2">
                        <button type="button" class="flex-1 px-3 py-2.5 border border-gray-300 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-100 transition-all">
                            <svg class="w-3 h-3 inline mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 12H5M12 19l-7-7 7-7"></path>
                            </svg>
                            Annuler
                        </button>
                        <button type="submit" class="flex-1 px-3 py-2.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg text-sm font-semibold hover:from-orange-600 hover:to-orange-700 transition-all shadow-lg">
                            <svg class="w-3 h-3 inline mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M7 17l9.2-9.2M17 17H7v-10"></path>
                            </svg>
                            Envoyer
                        </button>
                    </div>
                    
                    <!-- Informations de sécurité -->
                    <div class="mt-2 text-center">
                        <div class="inline-flex items-center gap-1 text-gray-600">
                            <svg class="w-3 h-3 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 12l2 2 4-4"></path>
                                <path d="M21 12c-1 0-3-1-3-3s2-3 3-3 3 1 3 3-2 3 3 3"></path>
                                <path d="M3 12c1 0 3-1 3-3s-2-3-3-3-3 1-3 3 2 3 3 3"></path>
                            </svg>
                            <span class="text-xs">Transfert sécurisé</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Ajouter la fonctionnalité des boutons de montant rapide
        const quickAmountButtons = document.querySelectorAll('button[type="button"]');
        const montantInput = document.getElementById('montant');

        quickAmountButtons.forEach(button => {
            if (button.textContent.includes('K')) {
                button.addEventListener('click', () => {
                    const amount = button.textContent.replace('K', '000');
                    montantInput.value = amount;
                    montantInput.focus();
                });
            }
        });

        // Formater le numéro de téléphone pendant la saisie
        const numeroInput = document.getElementById('numero');
        numeroInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + ' ' + value.substring(2);
            }
            if (value.length >= 6) {
                value = value.substring(0, 6) + ' ' + value.substring(6);
            }
            if (value.length >= 9) {
                value = value.substring(0, 9) + ' ' + value.substring(9, 11);
            }
            e.target.value = value;
        });
    </script>
</body>
</html>