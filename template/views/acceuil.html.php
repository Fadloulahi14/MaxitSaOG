        <!-- Sidebar -->
       
        
        <!-- Main Content -->
        
            <!-- Header -->
            
            <!-- Transaction Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <?php if (!empty($transactions)): ?>
                    <?php foreach ($transactions as $transaction): ?>
                        <div class="bg-white border-2 border-orange-200 rounded-2xl p-6 hover:border-orange-500 cursor-pointer transform hover:-translate-y-1 transition-all">
                            <div class="flex justify-between items-center mb-4">
                                <span class="font-semibold text-gray-700"><?= htmlspecialchars($transaction['type']) ?></span>
                                <span class="font-bold text-lg <?= $transaction['montant'] < 0 ? 'text-red-600' : 'text-green-600' ?>">
                                    <?= number_format($transaction['montant'], 0, ',', ' ') ?> F
                                </span>
                            </div>
                            <div class="text-gray-500 text-sm mb-2"><?= date('d/m/Y H:i', strtotime($transaction['date'])) ?></div>
                            <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">Terminé</span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500 text-lg">Aucune transaction trouvée.</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- View More Button -->
            <div class="text-center">
                <a href="/transactions" class="bg-orange-400 text-white px-8 py-4 rounded-full font-semibold hover:bg-orange-500 transition-colors">
                    Voir toutes les transactions
                </a>
            </div>
        </div>
  