                          <!-- Formulaire Ajouter un Compte -->
                          <div class="max-w-md">
                              <h2 class="text-2xl font-bold text-gray-800 mb-6">Ajouter un Compte Secondaire</h2>
                
                              <?php if (isset($error['global'])): ?>
                                  <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                                      <p class="text-red-600"><?= htmlspecialchars($error['global']) ?></p>
                                  </div>
                              <?php endif; ?>
                
                              <?php if (isset($success)): ?>
                                  <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                                      <p class="text-green-600"><?= htmlspecialchars($success) ?></p>
                                  </div>
                              <?php endif; ?>
                
                              <form method="POST" action="/secondaire" class="space-y-6">
                                  <div>
                                      <label for="telephone" class="block text-lg font-medium text-gray-700 mb-3">Numéro de téléphone *</label>
                                      <input 
                                          type="tel" 
                                          id="telephone" 
                                          name="telephone" 
                                          class="w-full px-4 py-3 border-2 border-orange-200 rounded-full outline-none focus:border-orange-500 text-gray-700 <?= isset($error['telephone']) ? 'border-red-500' : '' ?>"
                                          placeholder="Ex: 778012345"
                                          value="<?= htmlspecialchars($donnees['telephone'] ?? '') ?>"
                                          required
                                      >
                                      <?php if (isset($error['telephone'])): ?>
                                          <span class="text-red-500 text-sm mt-1 block"><?= htmlspecialchars($error['telephone']) ?></span>
                                      <?php endif; ?>
                                      <small class="text-gray-500 text-sm mt-1 block">Entrez un numéro de 9 chiffres (sans indicatif)</small>
                                  </div>
                    
                                  <div>
                                      <label for="solde" class="block text-lg font-medium text-gray-700 mb-3">Solde initial (optionnel)</label>
                                      <input 
                                          type="number" 
                                          id="solde" 
                                          name="solde" 
                                          min="0"
                                          step="1"
                                          class="w-full px-4 py-3 border-2 border-orange-200 rounded-full outline-none focus:border-orange-500 text-gray-700 <?= isset($error['solde']) ? 'border-red-500' : '' ?>"
                                          placeholder="Ex: 10000"
                                          value="<?= htmlspecialchars($donnees['solde'] ?? '') ?>"
                                      >
                                      <?php if (isset($error['solde'])): ?>
                                          <span class="text-red-500 text-sm mt-1 block"><?= htmlspecialchars($error['solde']) ?></span>
                                      <?php endif; ?>
                                      <small class="text-gray-500 text-sm mt-1 block">
                                          Montant en FCFA. Ce montant sera débité de votre compte principal.
                                          <br>Votre solde actuel : <strong><?= number_format($solde ?? 0, 0, ',', ' ') ?> F</strong>
                                      </small>
                                  </div>
                    
                                  <div>
                                      <button 
                                          type="submit" 
                                          class="w-full bg-orange-400 text-white px-8 py-4 rounded-full font-semibold hover:bg-orange-500 transition-colors"
                                      >
                                          Créer le compte secondaire
                                      </button>
                                  </div>
                              </form>
                
                              <div class="mt-8 text-center">
                                  <a href="/store" class="text-orange-500 hover:text-orange-600 font-medium">
                                      ← Retour à l'accueil
                                  </a>
                              </div>
                          </div>
        