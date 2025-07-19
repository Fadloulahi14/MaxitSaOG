           
        <div class="w-20 bg-orange-400 flex flex-col py-4 fixed h-full z-50">

         <a href="store">
            <div class="flex items-center justify-center h-15 mb-4 bg-orange-600 mx-2 rounded-lg">
                <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9,22 9,12 15,12 15,22"></polyline>
                </svg>
            </div>

            </a>
            
            <a href="secondaire">
                 <div  class="flex items-center justify-center h-15 mb-4 hover:bg-orange-600 mx-2 rounded-lg cursor-pointer">
                <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </div>

            </a>

            <div class="flex items-center justify-center h-15 mb-4 hover:bg-orange-600 mx-2 rounded-lg cursor-pointer">
                <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                </svg>
            </div>
            <div class="flex items-center justify-center h-15 mb-4 hover:bg-orange-600 mx-2 rounded-lg cursor-pointer">
                <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <line x1="8" y1="6" x2="21" y2="6"></line>
                    <line x1="8" y1="12" x2="21" y2="12"></line>
                    <line x1="8" y1="18" x2="21" y2="18"></line>
                    <line x1="3" y1="6" x2="3.01" y2="6"></line>
                    <line x1="3" y1="12" x2="3.01" y2="12"></line>
                    <line x1="3" y1="18" x2="3.01" y2="18"></line>
                </svg>
            </div>
            <div class="flex items-center justify-center h-15 mb-4 hover:bg-orange-600 mx-2 rounded-lg cursor-pointer">
                <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <polyline points="22,12 18,12 15,21 9,3 6,12 2,12"></polyline>
                </svg>
            </div>


             
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 ml-20 p-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <div class="flex-1 max-w-md">
                    <input type="text" class="w-full px-4 py-3 border-2 border-orange-200 rounded-full outline-none focus:border-orange-500" placeholder="Rechercher une transaction...">
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 border-2 border-orange-200 rounded-lg bg-white flex items-center justify-center hover:border-orange-500 cursor-pointer">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </div>
                    <div class="w-10 h-10 border-2 border-orange-200 rounded-lg bg-white flex items-center justify-center hover:border-orange-500 cursor-pointer">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                    </div>
                    <?php if (isset($comptes) && count($comptes) > 1): ?>
                        <select class="bg-orange-400 text-white px-4 py-2 rounded-lg font-semibold border-none outline-none cursor-pointer" 
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
                        <div class="bg-orange-400 text-white px-4 py-2 rounded-lg font-semibold">
                            +221 <?= htmlspecialchars($numero) ?>   >
                        </div>
                    <?php endif; ?>

                    <a href="<?php ?>logout" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition duration-200">
                     Déconnexion
                </a>
                </div>
            </div>
            
            <!-- Balance Card -->
            <div class="bg-gradient-to-br from-orange-400 to-orange-500 rounded-2xl p-8 text-white mb-8 relative">
                <div class="bg-white bg-opacity-90 text-gray-700 px-4 py-2 rounded-full font-semibold inline-block mb-4">
                    Solde: <?= number_format($solde, 2, ',', ' ') ?> F
                </div>
                <div class="flex items-center gap-2 text-white hover:underline cursor-pointer">
                    <span class="font-medium">Voir Transaction</span>
                    <span>→</span>
                </div>
                <div class="absolute top-4 right-4 w-20 h-20 bg-white rounded-lg flex items-center justify-center">
                    <div class="w-15 h-15 bg-black opacity-80 rounded" style="background-image: radial-gradient(circle at 20% 20%, #000 2px, transparent 2px), radial-gradient(circle at 80% 20%, #000 2px, transparent 2px), radial-gradient(circle at 20% 80%, #000 2px, transparent 2px), radial-gradient(circle at 80% 80%, #000 2px, transparent 2px); background-size: 8px 8px;">
                    </div>
                </div>
            </div>
            

   































    