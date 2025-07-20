<div class="w-20 bg-gradient-to-b from-orange-500 to-orange-600 flex flex-col py-6 fixed h-full z-50 shadow-2xl">
        <!-- Logo/Home - Icône Maison -->
        <a href="store" class="group mb-6">
            <div class="flex items-center justify-center h-12 mb-2 bg-orange-700 mx-3 rounded-xl shadow-lg transform transition-all duration-300 group-hover:scale-110 group-hover:shadow-2xl group-hover:bg-orange-800">
                <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9,22 9,12 15,12 15,22"></polyline>
                </svg>
            </div>
        </a>
        
        <!-- Navigation Items -->
        <nav class="flex flex-col space-y-4">
            <!-- Secondaire - Icône Utilisateur Plus -->
            <a href="secondaire" class="group">
                <div class="flex items-center justify-center h-12 hover:bg-orange-700 mx-3 rounded-xl cursor-pointer transform transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg">
                    <svg class="w-6 h-6 text-white group-hover:text-orange-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <line x1="19" y1="8" x2="19" y2="14"></line>
                        <line x1="22" y1="11" x2="16" y2="11"></line>
                    </svg>
                </div>
            </a>
            
            <!-- List - Icône Liste -->
            <a href="list" class="group">
                <div class="flex items-center justify-center h-12 hover:bg-orange-700 mx-3 rounded-xl cursor-pointer transform transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg">
                    <svg class="w-6 h-6 text-white group-hover:text-orange-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M8 6h13"></path>
                        <path d="M8 12h13"></path>
                        <path d="M8 18h13"></path>
                        <path d="M3 6h.01"></path>
                        <path d="M3 12h.01"></path>
                        <path d="M3 18h.01"></path>
                    </svg>
                </div>
            </a>
            
            <!-- Transfert d'argent - Nouvel icône -->
             <a href="transfert">
                <div class="group cursor-pointer">
                    <div class="flex items-center justify-center h-12 hover:bg-orange-700 mx-3 rounded-xl transform transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg">
                        <svg class="w-6 h-6 text-white group-hover:text-orange-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7 17l9.2-9.2M17 17H7v-10"></path>
                            <circle cx="12" cy="12" r="1"></circle>
                            <path d="M16 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"></path>
                            <path d="M21 12c-1 0-3-1-3-3s2-3 3-3 3 1 3 3-2 3-3 3"></path>
                            <path d="M3 12c1 0 3-1 3-3s-2-3-3-3-3 1-3 3 2 3 3 3"></path>
                        </svg>
                    </div>
                </div>
            </a>
            
            <!-- Menu - Icône Paramètres -->
            <div class="group cursor-pointer">
                <div class="flex items-center justify-center h-12 hover:bg-orange-700 mx-3 rounded-xl transform transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg">
                    <svg class="w-6 h-6 text-white group-hover:text-orange-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M12 1v6m0 6v6"></path>
                        <path d="M21 12h-6m-6 0H3"></path>
                        <path d="M21 6l-3.5 3.5L15 7l-1.5-1.5L10 9"></path>
                        <path d="M3 18l3.5-3.5L9 17l1.5 1.5L14 15"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Statistiques - Icône Graphique -->
            <div class="group cursor-pointer">
                <div class="flex items-center justify-center h-12 hover:bg-orange-700 mx-3 rounded-xl transform transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg">
                    <svg class="w-6 h-6 text-white group-hover:text-orange-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 3v18h18"></path>
                        <path d="M18 17V9"></path>
                        <path d="M13 17V5"></path>
                        <path d="M8 17v-3"></path>
                    </svg>
                </div>
            </div>
        </nav>
    </div>
        
          <div class="flex-1 ml-20 p-8">
        <!-- Header Professionnel -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4 bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <input type="text" class="w-full px-6 py-4 border-2 border-orange-200 rounded-2xl outline-none focus:border-orange-500 focus:shadow-lg transition-all duration-300 pl-12 bg-gray-50 focus:bg-white" placeholder="Rechercher une transaction...">
                    <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 transform -translate-y-1/2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <!-- Bouton de recherche professionnel -->
                <div class="w-12 h-12 border-2 border-orange-200 rounded-xl bg-gradient-to-r from-orange-50 to-orange-100 flex items-center justify-center hover:border-orange-500 hover:shadow-lg cursor-pointer transform transition-all duration-300 hover:scale-105">
                    <svg class="w-5 h-5 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </div>
                
                <!-- Bouton notifications professionnel -->
                <div class="w-12 h-12 border-2 border-orange-200 rounded-xl bg-gradient-to-r from-orange-50 to-orange-100 flex items-center justify-center hover:border-orange-500 hover:shadow-lg cursor-pointer transform transition-all duration-300 hover:scale-105 relative">
                    <svg class="w-5 h-5 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    <div class="w-3 h-3 bg-red-500 rounded-full absolute -top-1 -right-1 border-2 border-white"></div>
                </div>
                
                <!-- Sélecteur de compte avec votre PHP -->
                <?php if (isset($comptes) && count($comptes) > 1): ?>
                    <select class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-3 rounded-xl font-semibold border-none outline-none cursor-pointer shadow-lg hover:shadow-xl transition-all duration-300 hover:from-orange-600 hover:to-orange-700" 
                            onchange="window.location.href='?compte=' + this.value">
                        <?php foreach ($comptes as $compte): ?>
                            <option value="<?= htmlspecialchars($compte['id']) ?>" 
                                    <?= ($compte['numeroTelephone'] == $numero) ? 'selected' : '' ?>>
                                +221 <?= htmlspecialchars($compte['numeroTelephone']) ?>
                                <?= $compte['estPrincipale'] ? ' (Principal)' : ' (Secondaire)' ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php else: ?>
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg">
                        +221 <?= htmlspecialchars($numero) ?>
                    </div>
                <?php endif; ?>

                <!-- Bouton déconnexion professionnel -->
                <a href="logout" class="bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 inline mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16,17 21,12 16,7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Déconnexion
                </a>
            </div>
        </div>

        <div class="bg-gradient-to-br from-orange-400 via-orange-500 to-orange-600 rounded-3xl p-8 text-white mb-8 relative overflow-hidden shadow-2xl">
            <!-- Motif de fond professionnel -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-full h-full" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.1) 10px, rgba(255,255,255,0.1) 20px);"></div>
            </div>
                <div class="relative z-10">
                        <!-- Affichage du solde avec votre PHP -->
                        <div class="bg-white bg-opacity-95 text-gray-800 px-6 py-4 rounded-2xl font-bold inline-flex items-center gap-3 mb-6 shadow-lg">
                            <svg class="w-6 h-6 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                <line x1="1" y1="10" x2="23" y2="10"></line>
                            </svg>
                            <span class="text-xl">Solde: <?= number_format($solde, 2, ',', ' ') ?> F CFA</span>
                        </div>
                        
                        <!-- Bouton Voir Transaction avec votre fonctionnalité -->
                        <div class="flex items-center gap-3 text-white hover:text-orange-100 cursor-pointer group transform transition-all duration-300 hover:scale-105">
                            <span class="font-semibold text-lg">Voir Transactions</span>
                            <svg class="w-6 h-6 transform transition-transform duration-300 group-hover:translate-x-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12,5 19,12 12,19"></polyline>
                            </svg>
                        </div>
                    </div>

                     <div class="flex items-center gap-3 text-white hover:text-orange-100 cursor-pointer group transform transition-all duration-300 hover:scale-105">
                    
                  
                </div>
            </div>


        