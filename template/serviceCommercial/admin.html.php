<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Service Commercial</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .slide-in {
            animation: slideIn 0.5s ease-out;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }
        .pulse-hover:hover {
            animation: pulse 0.6s ease-in-out;
        }
        .admin-gradient {
            background: linear-gradient(135deg, #f97316 100%, #ea580c 100%, #dc2626 100%);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Admin Sidebar -->
        <div class="w-64 admin-gradient flex flex-col py-6 fixed h-full z-50 shadow-2xl">
            <!-- Admin Header -->
            <div class="px-6 mb-8">
                <div class="flex items-center gap-3 bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl p-4">
                    <div class="w-10 h-10 bg-white bg-opacity-30 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-white font-bold text-sm">ADMIN</h2>
                        <p class="text-white text-opacity-80 text-xs">Service Commercial</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="flex-1 px-4 space-y-2">
                <div class= "hover:bg-white hover:bg-opacity-10 rounded-xl p-3 cursor-pointer transition-all duration-200">
                    <div class="flex items-center gap-3 text-white">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9,22 9,12 15,12 15,22"/>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </div>
                </div>
                
                <div class="bg-orange-600 bg-opacity-80 rounded-xl p-3 mb-2">
                    <div class="flex items-center gap-3 text-white">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.35-4.35"/>
                        </svg>
                        <span class="font-medium">Recherche Comptes</span>
                    </div>
                </div>
                
                <div class= "bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-3 mb-4">
                    <div class="flex items-center gap-3 text-white">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        <span class="font-medium">consulter un compte </span>
                    </div>
                </div>
                
                <!-- <div class="hover:bg-white hover:bg-opacity-10 rounded-xl p-3 cursor-pointer transition-all duration-200">
                    <div class="flex items-center gap-3 text-white">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="8" y1="6" x2="21" y2="6"/>
                            <line x1="8" y1="12" x2="21" y2="12"/>
                            <line x1="8" y1="18" x2="21" y2="18"/>
                            <line x1="3" y1="6" x2="3.01" y2="6"/>
                            <line x1="3" y1="12" x2="3.01" y2="12"/>
                            <line x1="3" y1="18" x2="3.01" y2="18"/>
                        </svg>
                        <span class="font-medium">Transactions</span>
                    </div>
                </div> -->
                
                <!-- <div class="hover:bg-white hover:bg-opacity-10 rounded-xl p-3 cursor-pointer transition-all duration-200">
                    <div class="flex items-center gap-3 text-white">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="22,12 18,12 15,21 9,3 6,12 2,12"/>
                        </svg>
                        <span class="font-medium">Statistiques</span>
                    </div>
                </div> -->
                
                <!-- <div class="hover:bg-white hover:bg-opacity-10 rounded-xl p-3 cursor-pointer transition-all duration-200">
                    <div class="flex items-center gap-3 text-white">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="3"/>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                        </svg>
                        <span class="font-medium">Paramètres</span>
                    </div>
                </div> -->
            </nav>
            
            <!-- Admin Info -->
            <div class="px-4 mt-auto">
                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-4">
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-10 h-10 bg-white bg-opacity-30 rounded-full flex items-center justify-center">
                            <span class="font-bold text-sm">AC</span>
                        </div>
                        <div>
                            <p class="font-medium text-sm">Admin Commercial</p>
                            <p class="text-xs text-white text-opacity-70">En ligne</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 ml-64 p-8">
            <!-- Header -->
            <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center mb-8 gap-6">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">Services Commercial</h1>
                    <p class="text-gray-600 text-lg">Recherche et gestion des comptes clients</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded-xl font-medium">
                        🟢 Système opérationnel
                    </div>
                    <div class="bg-orange-100 text-orange-800 px-4 py-2 rounded-xl font-medium">
                        📊 1,247 comptes actifs
                    </div>
                </div>
            </div>
            
            <!-- Search Section -->
            <div class="bg-white rounded-3xl shadow-lg border border-orange-100 p-8 mb-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 admin-gradient rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.35-4.35"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Recherche de Compte Client</h2>
                        <p class="text-gray-600">Entrez le numéro de téléphone pour consulter les informations du compte</p>
                    </div>
                </div>
                
                <div class="relative max-w-3xl">
                    <input 
                        type="text" 
                        id="searchAccount"
                        class="w-full px-8 py-6 border-2 border-orange-200 rounded-2xl outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all duration-200 text-xl font-medium shadow-sm"
                        placeholder="Ex: +221 77 123 45 67 ou 771234567"
                    >
                    <div class="absolute right-6 top-1/2 transform -translate-y-1/2 flex items-center gap-3">
                        <div class="text-gray-400 text-sm">Appuyez sur Entrée</div>
                        <button id="searchBtn" class="admin-gradient text-white p-3 rounded-xl hover:shadow-lg transition-all duration-200 pulse-hover">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="m21 21-4.35-4.35"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            
            <div id="accountInfo" class="hidden slide-in">
                <div class="admin-gradient rounded-3xl p-8 text-white mb-8 relative overflow-hidden shadow-2xl">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white bg-opacity-10 rounded-full -mr-20 -mt-20"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-white bg-opacity-10 rounded-full -ml-16 -mb-16"></div>
                    
                    <div class="relative z-10">
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
                            <div class="space-y-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                            <circle cx="12" cy="7" r="4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold">Compte Client</h3>
                                        <p class="text-white text-opacity-80">Informations du compte</p>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl p-4">
                                        <p class="text-white text-opacity-70 text-sm mb-1">Numéro de téléphone</p>
                                        <p id="phoneNumber" class="text-white font-bold text-lg">+221 77 123 45 67</p>
                                    </div>
                                    <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl p-4">
                                        <p class="text-white text-opacity-70 text-sm mb-1">Statut du compte</p>
                                        <p class="text-green-200 font-bold text-lg">✓ Actif</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-3xl p-8 text-center">
                                <p class="text-white text-opacity-70 text-sm mb-2">Solde actuel</p>
                                <p class="text-white font-bold text-3xl">00000 F</p>
                                <p class="text-white font-bold text-lg">CFA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div id="transactionsSection" class="hidden slide-in">
                <div class="bg-white rounded-3xl shadow-lg border border-orange-100 p-8 mb-8">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="8" y1="6" x2="21" y2="6"/>
                                    <line x1="8" y1="12" x2="21" y2="12"/>
                                    <line x1="8" y1="18" x2="21" y2="18"/>
                                    <line x1="3" y1="6" x2="3.01" y2="6"/>
                                    <line x1="3" y1="12" x2="3.01" y2="12"/>
                                    <line x1="3" y1="18" x2="3.01" y2="18"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Dernières Transactions</h2>
                                <p class="text-gray-600">10 transactions les plus récentes</p>
                            </div>
                        </div>
                        <button id="viewAllBtn" class="admin-gradient text-white px-8 py-4 rounded-2xl font-semibold hover:shadow-lg transition-all duration-200 pulse-hover">
                            Voir toutes les transactions →
                        </button>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="bg-gray-50 border-2 border-orange-100 rounded-2xl p-6 hover:border-orange-300 hover:shadow-md transition-all duration-200">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M7 17L17 7M17 7H7M17 7V17"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 text-lg">Dépôt d'argent</h4>
                                        <p class="text-gray-600">13 juillet 2025 à 14:30</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-2xl text-green-600">+25,000 F</p>
                                    <span class="inline-block px-4 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">Terminé</span>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                    </div>
                </div>
            </div>
            
           
            <div id="allTransactionsSection" class="hidden slide-in">
                <div class="bg-white rounded-3xl shadow-lg border border-orange-100 p-8 mb-8">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14,2 14,8 20,8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                    <polyline points="10,9 9,9 8,9"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Historique Complet</h2>
                                <p class="text-gray-600">Toutes les transactions avec filtres avancés</p>
                            </div>
                        </div>
                        <button id="backToRecentBtn" class="bg-gray-500 text-white px-8 py-4 rounded-2xl font-semibold hover:bg-gray-600 transition-colors">
                            ← Retour aux récentes
                        </button>
                    </div>
                    
                   
                    <div class="bg-gray-50 rounded-2xl p-6 mb-8">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Filtres de recherche</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date de début</label>
                                <input type="date" class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl outline-none focus:border-orange-500 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date de fin</label>
                                <input type="date" class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl outline-none focus:border-orange-500 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Type de transaction</label>
                                <select class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl outline-none focus:border-orange-500 transition-colors">
                                    <option value="">Tous les types</option>
                                    <option value="depot">Dépôt</option>
                                    <option value="transfert">Transfert</option>
                                    <option value="paiement">Paiement</option>
                                    <option value="retrait">Retrait</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                                <select class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl outline-none focus:border-orange-500 transition-colors">
                                    <option value="">Tous les statuts</option>
                                    <option value="termine">Terminé</option>
                                    <option value="en_cours">En cours</option>
                                    <option value="echoue">Échoué</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end gap-4">
                            <button class="bg-gray-400 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-500 transition-colors">
                                Réinitialiser
                            </button>
                            <button class="admin-gradient text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-200 pulse-hover">
                                Appliquer les filtres
                            </button>
                        </div>
                    </div>
                    
                    <!-- Transactions Table -->
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-orange-100 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="admin-gradient text-white">
                                    <tr>
                                        <th class="px-6 py-4 text-left font-semibold">Date & Heure</th>
                                        <th class="px-6 py-4 text-left font-semibold">Type</th>
                                        <th class="px-6 py-4 text-left font-semibold">Montant</th>
                                        <th class="px-6 py-4 text-left font-semibold">Statut</th>
                                        <th class="px-6 py-4 text-left font-semibold">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-orange-100">
                                    <tr class="hover:bg-orange-50 transition-colors">
                                        <td class="px-6 py-4 text-gray-700 font-medium">13/07/2025 14:30</td>
                                        <td class="px-6 py-4 text-gray-700">Dépôt d'argent</td>
                                        <td class="px-6 py-4 font-bold text-green-600 text-lg">+25,000 F</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">Terminé</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <button class="text-orange-600 hover:text-orange-800 font-medium hover:underline transition-colors">
                                                Détails
                                            </button>
                                        </td>
                                    </tr>
                                   
                                    
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-gray-600">
                            Affichage de 1 à 8 sur 247 transactions
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition-colors disabled:opacity-50" disabled>
                                ← Précédent
                            </button>
                            <button class="px-4 py-2 admin-gradient text-white rounded-lg font-medium">1</button>
                            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition-colors">2</button>
                            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition-colors">3</button>
                            <span class="px-2 text-gray-500">...</span>
                            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition-colors">31</button>
                            <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300 transition-colors">
                                Suivant →
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions
            <div class="bg-white rounded-3xl shadow-lg border border-orange-100 p-8 mb-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Actions Rapides</h2>
                        <p class="text-gray-600">Outils d'administration pour la gestion des comptes</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <button class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-2xl hover:shadow-lg transition-all duration-200 pulse-hover">
                        <div class="flex items-center gap-4">
                            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"/>
                                <path d="M12 6v6l4 2"/>
                            </svg>
                            <div class="text-left">
                                <h3 class="font-bold text-lg">Bloquer le compte</h3>
                                <p class="text-blue-100 text-sm">Suspendre temporairement</p>
                            </div>
                        </div>
                    </button>
                    
                    <button class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-2xl hover:shadow-lg transition-all duration-200 pulse-hover">
                        <div class="flex items-center gap-4">
                            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 12l2 2 4-4"/>
                                <path d="M21 12c-1 0-3-1-3-3s2-3 3-3 3 1 3 3-2 3-3 3"/>
                                <path d="M3 12c1 0 3-1 3-3s-2-3-3-3-3 1-3 3 2 3 3 3"/>
                                <path d="M9 21c0-1-1-3-3-3s-3 2-3 3 1 3 3 3 3-2 3-3"/>
                                <path d="M15 21c0-1 1-3 3-3s3 2 3 3-1 3-3 3-3-2-3-3"/>
                            </svg>
                            <div class="text-left">
                                <h3 class="font-bold text-lg">Activer le compte</h3>
                                <p class="text-green-100 text-sm">Réactiver si suspendu</p>
                            </div>
                        </div>
                    </button>
                    
                    <button class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-2xl hover:shadow-lg transition-all duration-200 pulse-hover">
                        <div class="flex items-center gap-4">
                            <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14,2 14,8 20,8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                                <polyline points="10,9 9,9 8,9"/>
                            </svg>
                            <div class="text-left">
                                <h3 class="font-bold text-lg">Générer rapport</h3>
                                <p class="text-purple-100 text-sm">Exporter les données</p>
                            </div>
                        </div>
                    </button>
                </div>
            </div> -->
        </div>
    </div>
    
    <script>
        // Search functionality
        const searchInput = document.getElementById('searchAccount');
        const searchBtn = document.getElementById('searchBtn');
        const accountInfo = document.getElementById('accountInfo');
        const transactionsSection = document.getElementById('transactionsSection');
        const allTransactionsSection = document.getElementById('allTransactionsSection');
        const phoneNumber = document.getElementById('phoneNumber');
        const viewAllBtn = document.getElementById('viewAllBtn');
        const backToRecentBtn = document.getElementById('backToRecentBtn');
        
        function performSearch() {
            const phone = searchInput.value.trim();
            if (phone) {
                phoneNumber.textContent = phone;
                accountInfo.classList.remove('hidden');
                transactionsSection.classList.remove('hidden');
                allTransactionsSection.classList.add('hidden');
                
                // Smooth scroll to results
                accountInfo.scrollIntoView({ behavior: 'smooth' });
            }
        }
        
        searchBtn.addEventListener('click', performSearch);
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
        
        // View all transactions
        viewAllBtn.addEventListener('click', function() {
            transactionsSection.classList.add('hidden');
            allTransactionsSection.classList.remove('hidden');
            allTransactionsSection.scrollIntoView({ behavior: 'smooth' });
        });
        
        // Back to recent transactions
        backToRecentBtn.addEventListener('click', function() {
            allTransactionsSection.classList.add('hidden');
            transactionsSection.classList.remove('hidden');
            transactionsSection.scrollIntoView({ behavior: 'smooth' });
        });
        
        // Add smooth hover effects
        document.querySelectorAll('.pulse-hover').forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.02)';
            });
            
            element.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
        
        // Simulate real-time updates
        setInterval(() => {
            const statusIndicator = document.querySelector('.bg-green-100.text-green-800');
            if (statusIndicator) {
                statusIndicator.style.opacity = '0.7';
                setTimeout(() => {
                    statusIndicator.style.opacity = '1';
                }, 500);
            }
        }, 3000);
    </script>
</body>
</html>