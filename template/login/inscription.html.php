<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <div class="container">
        <h1 class="title">Inscription</h1>
        
        <div id="error-message" class="error-message" style="display: none;"></div>
        <div id="success-message" class="success-message" style="display: none;"></div>
        <?php if (isset($error['global'])): ?>
            <div class="error-message">
                <?= htmlspecialchars($error['global']) ?>
            </div>
        <?php endif; ?>
        
        <form id="inscriptionForm" action="/inscription" method="post" enctype="multipart/form-data">

            <!-- Champ CNI - Toujours actif -->
            <div class="form-group">
                <label for="cni" class="form-label">Numéro CNI *:</label>
                <div class="input-with-loader">
                    <input 
                        type="text" 
                        id="cni" 
                        name="cni" 
                        class="form-input <?= isset($error['cni']) ? 'error' : '' ?>"
                        value="<?= htmlspecialchars($donnees['cni'] ?? '') ?>"

                        placeholder="Ex: 1234567890123"
                        maxlength="13"
                    >
                    <div id="cni-loader" class="loader" style="display: none;"></div>
                </div>
                <small class="help-text">Saisissez 13 chiffres pour la vérification automatique</small>
            </div>
           
            <!-- Champs auto-remplis (bloqués) et champs utilisateur (libres) -->
            <div id="form-fields">
                <!-- Champs auto-remplis - bloqués jusqu'à validation CNI -->
                <div class="form-group">
                    <div class="form-row">
                        <div>
                            <label for="nom" class="form-label">Nom * (auto-rempli):</label>
                            <input 
                                type="text" 
                                id="nom" 
                                name="nom" 
                                class="form-input auto-fill <?= isset($error['nom']) ? 'error' : '' ?>"
                                 value="<?= htmlspecialchars($donnees['nom'] ?? '') ?>"

                                readonly
                                placeholder="Sera rempli automatiquement"
                            >
                             <?php if (isset($error['nom'])): ?>
                            <span class="error-text"><?= htmlspecialchars($error['nom']) ?></span>
                            <?php endif; ?>
                        </div>
                        <div>
                            <label for="prenom" class="form-label">Prénom * (auto-rempli):</label>
                            <input 
                                type="text" 
                                id="prenom" 
                                name="prenom" 
                                class="form-input auto-fill <?= isset($error['prenom']) ? 'error' : '' ?>"
                            value="<?= htmlspecialchars($donnees['prenom'] ?? '') ?>"

                                readonly
                                placeholder="Sera rempli automatiquement"
                            >
                            <?php if (isset($error['prenom'])): ?>
                            <span class="error-text"><?= htmlspecialchars($error['prenom']) ?></span>
                             <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Champs utilisateur - toujours libres -->
                <div class="form-group">
                    <div class="form-row">
                        <div>
                            <label for="adresse" class="form-label">Adresse *:</label>
                            <input 
                                type="text" 
                                id="adresse" 
                                name="adresse" 
                                class="form-input <?= isset($error['adresse']) ? 'error' : '' ?>"
                                placeholder="Votre adresse complète"
                            >
                             <?php if (isset($error['adresse'])): ?>
                            <span class="error-text"><?= htmlspecialchars($error['adresse']) ?></span>
                        <?php endif; ?>
                        </div>
                        <div>
                            <label for="tel" class="form-label">Téléphone *:</label>
                            <input 
                                type="tel" 
                                id="tel" 
                                name="tel" 
                                class="form-input <?= isset($error['tel']) ? 'error' : '' ?>"
                            value="<?= htmlspecialchars($donnees['telephone'] ?? '') ?>"

                                placeholder="Ex: 778012731"
                            >
                             <?php if (isset($error['tel'])): ?>
                            <span class="error-text"><?= htmlspecialchars($error['tel']) ?></span>
                        <?php endif; ?>
                            <small class="help-text">9 chiffres sans indicatif</small>
                            
                        </div>
                    </div>
                </div>

                <!-- Photos CNI - auto-remplies mais pas bloquantes -->
                <div class="upload-container">
                    <div class="upload-row">
                        <div>
                            <label for="photo-recto" class="upload-label">Photo CNI RECTO * (auto-remplie)</label>
                            <div class="upload-area <?= isset($error['photo-recto']) ? 'error' : '' ?>" id="recto-area">
                                <input 
                                    type="file" 
                                    id="photo-recto" 
                                    name="photo-recto" 
                                    accept="image/*"
                                    class="upload-input"
                                    style="display: none;"
                                >
                                <svg class="camera-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="upload-text">En attente du CNI</span>
                                <img id="recto-preview" class="preview-image" style="display: none;" />
                            </div>
                             <?php if (isset($error['photo-recto'])): ?>
                            <span class="error-text"><?= htmlspecialchars($error['photo-recto']) ?></span>
                        <?php endif; ?>
                        </div>
                        <div>
                            <label for="photo-verso" class="upload-label">Photo CNI VERSO * (auto-remplie)</label>
                            <div class="upload-area <?= isset($error['photo-verso']) ? 'error' : '' ?>" id="verso-area">
                                <input 
                                    type="file" 
                                    id="photo-verso" 
                                    name="photo-verso" 
                                    accept="image/*"
                                    class="upload-input"
                                    style="display: none;"
                                >
                                <svg class="camera-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="upload-text">En attente du CNI</span>
                                <img id="verso-preview" class="preview-image" style="display: none;" />
                            </div>
                             <?php if (isset($error['photo-verso'])): ?>
                            <span class="error-text"><?= htmlspecialchars($error['photo-verso']) ?></span>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Lien et bouton - toujours accessibles -->
                <a href="/" class="signup-link">Déjà inscrit ? Se connecter</a>
                
                <button type="submit" class="submit-btn" id="submit-btn">
                    S'inscrire
                </button>
            </div>
        </form>
    </div>
</body>
</html>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background-color: #f3f4f6;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    
    .container {
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        width: 100%;
        max-width: 28rem;
        position: relative;
    }
    
    .title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #374151;
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .error-message {
        background-color: #fee2e2;
        border: 1px solid #fecaca;
        color: #dc2626;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
        text-align: left;
    }
    
    .success-message {
        background-color: #d1fae5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
        text-align: left;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .input-with-loader {
        position: relative;
    }
    
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #fed7aa;
        border-radius: 9999px;
        color: black;
        outline: none;
        transition: border-color 0.3s ease;
    }
    
    .form-input:focus {
        border-color: #f97316;
    }
    
    .form-input:disabled {
        background-color: #f9fafb;
        color: #9ca3af;
        cursor: not-allowed;
    }
    
    .form-input.auto-fill {
        background-color: #f0f9ff;
        border-color: #bae6fd;
        color: #0369a1;
    }
    
    .form-input.auto-fill:focus {
        border-color: #0284c7;
    }
    
    .form-input.error {
        border-color: #dc2626;
    }
    
    .loader {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #f97316;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: translateY(-50%) rotate(0deg); }
        100% { transform: translateY(-50%) rotate(360deg); }
    }
    
    .help-text {
        color: #6b7280;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        display: block;
    }
    
    .blocked-section {
        position: relative;
    }
    
    .upload-container {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .upload-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    
    .upload-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 500;
        color: #4b5563;
        margin-bottom: 0.5rem;
    }
    
    .upload-area {
        position: relative;
        width: 100%;
        height: 6rem;
        border: 2px solid #fed7aa;
        border-radius: 1rem;
        background-color: #f9fafb;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .upload-area:hover:not(.disabled) {
        background-color: #f3f4f6;
        border-color: #f97316;
    }
    
    .upload-area.disabled {
        background-color: #f9fafb;
        border-color: #e5e7eb;
        cursor: not-allowed;
    }
    
    .upload-area.filled {
        border-color: #10b981;
        background-color: #f0fdf4;
    }
    
    .upload-input {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    
    .upload-input:disabled {
        cursor: not-allowed;
    }
    
    .camera-icon {
        width: 2rem;
        height: 2rem;
        color: #9ca3af;
        margin-bottom: 0.5rem;
    }
    
    .upload-text {
        font-size: 0.75rem;
        color: #6b7280;
        text-align: center;
    }
    
    .preview-image {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 1rem;
    }
    
    .signup-link {
        display: block;
        color: #f97316;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 500;
        margin-bottom: 2rem;
        transition: color 0.3s ease;
        text-align: center;
    }
    
    .signup-link:hover {
        color: #ea580c;
    }
    
    .submit-btn {
        width: 100%;
        background-color: #fb923c;
        color: white;
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 9999px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-bottom: 1rem;
    }
    
    .submit-btn:hover:not(:disabled) {
        background-color: #f97316;
    }
    
    .submit-btn:disabled {
        background-color: #d1d5db;
        cursor: not-allowed;
    }
    
    .submit-btn:focus:not(:disabled) {
        outline: none;
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.3);
    }
    
    @media (max-width: 640px) {
        .form-row, .upload-row {
            grid-template-columns: 1fr;
        }
        
        .container {
            padding: 1.5rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cniInput = document.getElementById('cni');
    const loader = document.getElementById('cni-loader');
    const errorMessage = document.getElementById('error-message');
    const successMessage = document.getElementById('success-message');
    const submitBtn = document.getElementById('submit-btn');
    
    // Champs à remplir automatiquement
    const nomInput = document.getElementById('nom');
    const prenomInput = document.getElementById('prenom');
    const rectoPreview = document.getElementById('recto-preview');
    const versoPreview = document.getElementById('verso-preview');
    const rectoArea = document.getElementById('recto-area');
    const versoArea = document.getElementById('verso-area');
    const telInput = document.getElementById('tel');
    const adresseInput = document.getElementById('adresse');
    
    let cniValidated = false;
    
    // Fonction pour afficher les messages
    function showMessage(type, message) {
        hideMessages();
        if (type === 'error') {
            errorMessage.textContent = message;
            errorMessage.style.display = 'block';
        } else if (type === 'success') {
            successMessage.textContent = message;
            successMessage.style.display = 'block';
        }
    }
    
    function hideMessages() {
        errorMessage.style.display = 'none';
        successMessage.style.display = 'none';
    }
    
    // Fonction pour effectuer la requête CNI
    async function fetchCNIData(numeroCNI) {
        try {
            loader.style.display = 'block';
            hideMessages();
            cniValidated = false;
            
            const response = await fetch('https://backendcnimaxit.onrender.com/api/citoyen');
            
            if (!response.ok) {
                throw new Error("Erreur lors de la requête vers le serveur");
            }
            
            const data = await response.json();
            
            if (!data.data || data.data.length === 0) {
                throw new Error("Aucune donnée trouvée dans la base");
            }
            
            const citoyen = data.data.find(c => c.nci === numeroCNI);
            
            if (!citoyen) {
                throw new Error("Aucun citoyen trouvé avec ce numéro CNI");
            }
            
            // Remplir automatiquement les champs
            nomInput.value = citoyen.nom || '';
            prenomInput.value = citoyen.prenom || '';
            
            // Charger les images si disponibles
            if (citoyen.url_carte_recto) {
                rectoPreview.src = citoyen.url_carte_recto;
                rectoPreview.style.display = 'block';
                rectoArea.classList.add('filled');
                rectoArea.querySelector('.upload-text').textContent = 'Image chargée automatiquement';
                rectoArea.querySelector('.camera-icon').style.display = 'none';
            }
            
            if (citoyen.url_carte_verso) {
                versoPreview.src = citoyen.url_carte_verso;
                versoPreview.style.display = 'block';
                versoArea.classList.add('filled');
                versoArea.querySelector('.upload-text').textContent = 'Image chargée automatiquement';
                versoArea.querySelector('.camera-icon').style.display = 'none';
            }
            
            cniValidated = true;
            showMessage('success', 'Informations CNI récupérées avec succès ! Veuillez compléter votre adresse et téléphone.');
            
        } catch (error) {
            showMessage('error', error.message);
            // Vider les champs auto-remplis en cas d'erreur
            nomInput.value = '';
            prenomInput.value = '';
            rectoPreview.style.display = 'none';
            versoPreview.style.display = 'none';
            rectoArea.classList.remove('filled');
            versoArea.classList.remove('filled');
            rectoArea.querySelector('.upload-text').textContent = 'En attente du CNI';
            versoArea.querySelector('.upload-text').textContent = 'En attente du CNI';
            rectoArea.querySelector('.camera-icon').style.display = 'block';
            versoArea.querySelector('.camera-icon').style.display = 'block';
            cniValidated = false;
        } finally {
            loader.style.display = 'none';
        }
    }
    
    // Écouter les changements sur le champ CNI
    cniInput.addEventListener('input', function() {
        // Supprimer tous les caractères non numériques
        this.value = this.value.replace(/[^0-9]/g, '');
        
        // Limiter à 13 chiffres
        if (this.value.length > 13) {
            this.value = this.value.slice(0, 13);
        }
        
        // Si moins de 13 chiffres, marquer comme non validé
        if (this.value.length < 13) {
            cniValidated = false;
            hideMessages();
        }
        
        // Si exactement 13 chiffres, déclencher la requête
        if (this.value.length === 13) {
            fetchCNIData(this.value);
        }
    });
    
    // Validation du téléphone
    telInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 9) {
            this.value = this.value.slice(0, 9);
        }
    });
    
    // Gestion de la soumission du formulaire
    document.getElementById('inscriptionForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Vérifications finales
        if (cniInput.value.length !== 13) {
            showMessage('error', 'Le numéro CNI doit contenir exactement 13 chiffres');
            return;
        }
        
        if (!cniValidated) {
            showMessage('error', 'Veuillez attendre la validation du CNI ou ressaisir un CNI valide');
            return;
        }
        
        if (!nomInput.value.trim() || !prenomInput.value.trim()) {
            showMessage('error', 'Les informations CNI n\'ont pas été récupérées correctement');
            return;
        }
        
        if (!telInput.value.trim() || telInput.value.length !== 9) {
            showMessage('error', 'Veuillez saisir un numéro de téléphone valide (9 chiffres)');
            return;
        }
        
        if (!adresseInput.value.trim()) {
            showMessage('error', 'Veuillez saisir votre adresse');
            return;
        }
        
        showMessage('success', 'Formulaire validé ! Soumission en cours...');
        
        // Ici vous pouvez soumettre le formulaire normalement
        // this.submit();
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const uploadInputs = document.querySelectorAll('.upload-input');
    
    uploadInputs.forEach(input => {
        input.addEventListener('change', function() {
            const uploadArea = this.closest('.upload-area');
            const uploadText = uploadArea.querySelector('.upload-text');
            
            if (this.files && this.files[0]) {
                const fileName = this.files[0].name;
                uploadText.textContent = fileName;
                uploadArea.style.borderColor = '#10b981';
                uploadArea.style.backgroundColor = '#f0fdf4';
            } else {
                uploadText.textContent = 'Cliquez pour choisir';
                uploadArea.style.borderColor = '#fed7aa';
                uploadArea.style.backgroundColor = '#f9fafb';
            }
        });
    });
    
    // Validation en temps réel du numéro de téléphone
    const telInput = document.getElementById('tel');
    if (telInput) {
        telInput.addEventListener('input', function() {
            // Supprimer tous les caractères non numériques
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Limiter à 9 chiffres
            if (this.value.length > 9) {
                this.value = this.value.slice(0, 9);
            }
        });
    }
    
    // Validation en temps réel du CNI
    const cniInput = document.getElementById('cni');
    if (cniInput) {
        cniInput.addEventListener('input', function() {
            // Supprimer tous les caractères non numériques
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Limiter à 13 chiffres
            if (this.value.length > 13) {
                this.value = this.value.slice(0, 13);
            }
        });
    }
});
</script>