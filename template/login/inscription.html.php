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
        
        <?php if (isset($error['global'])): ?>
            <div class="error-message">
                <?= htmlspecialchars($error['global']) ?>
            </div>
        <?php endif; ?>
        
        <form action="/inscription" method="post" enctype="multipart/form-data">
           
            <div class="form-group">
                <div class="form-row">
                    <div>
                        <label for="nom" class="form-label">Nom *:</label>
                        <input 
                            type="text" 
                            id="nom" 
                            name="nom" 
                            class="form-input <?= isset($error['nom']) ? 'error' : '' ?>"
                            value="<?= htmlspecialchars($donnees['nom'] ?? '') ?>"
                           
                        >
                        <?php if (isset($error['nom'])): ?>
                            <span class="error-text"><?= htmlspecialchars($error['nom']) ?></span>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="prenom" class="form-label">Prénom *:</label>
                        <input 
                            type="text" 
                            id="prenom" 
                            name="prenom" 
                            class="form-input <?= isset($error['prenom']) ? 'error' : '' ?>"
                            value="<?= htmlspecialchars($donnees['prenom'] ?? '') ?>"
                            
                        >
                        <?php if (isset($error['prenom'])): ?>
                            <span class="error-text"><?= htmlspecialchars($error['prenom']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

          
            <div class="form-group">
                <label for="cni" class="form-label">Numéro CNI *:</label>
                <input 
                    type="text" 
                    id="cni" 
                    name="cni" 
                    class="form-input <?= isset($error['cni']) ? 'error' : '' ?>"
                    value="<?= htmlspecialchars($donnees['cni'] ?? '') ?>"
                    placeholder="Ex: 1234567890123"
                    
                >
                <?php if (isset($error['cni'])): ?>
                    <span class="error-text"><?= htmlspecialchars($error['cni']) ?></span>
                <?php endif; ?>
                <small class="help-text">Entre 10 et 13 chiffres</small>
            </div>

           
            <div class="form-group">
                <div class="form-row">
                    <div>
                        <label for="adresse" class="form-label">Adresse *:</label>
                        <input 
                            type="text" 
                            id="adresse" 
                            name="adresse" 
                            class="form-input <?= isset($error['adresse']) ? 'error' : '' ?>"
                            value="<?= htmlspecialchars($donnees['adresse'] ?? '') ?>"
                            
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

          
            <div class="upload-container">
                <div class="upload-row">
                    <div>
                        <label for="photo-recto" class="upload-label">Photo CNI RECTO *</label>
                        <div class="upload-area <?= isset($error['photo-recto']) ? 'error' : '' ?>">
                            <input 
                                type="file" 
                                id="photo-recto" 
                                name="photo-recto" 
                                accept="image/*"
                                class="upload-input"
                               
                            >
                            <svg class="camera-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="upload-text">Cliquez pour choisir</span>
                        </div>
                        <?php if (isset($error['photo-recto'])): ?>
                            <span class="error-text"><?= htmlspecialchars($error['photo-recto']) ?></span>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="photo-verso" class="upload-label">Photo CNI VERSO *</label>
                        <div class="upload-area <?= isset($error['photo-verso']) ? 'error' : '' ?>">
                            <input 
                                type="file" 
                                id="photo-verso" 
                                name="photo-verso" 
                                accept="image/*"
                                class="upload-input"
                                
                            >
                            <svg class="camera-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="upload-text">Cliquez pour choisir</span>
                        </div>
                        <?php if (isset($error['photo-verso'])): ?>
                            <span class="error-text"><?= htmlspecialchars($error['photo-verso']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <a href="/" class="signup-link">Déjà inscrit ? Se connecter</a>
            
            <button type="submit" class="submit-btn">
                S'inscrire
            </button>
        </form>
        
        <!-- Informations sur les champs obligatoires -->
        <!-- <div class="info-box">
            <p><strong>Informations importantes :</strong></p>
            <ul>
                <li>Tous les champs marqués d'un * sont obligatoires</li>
                <li>Les photos doivent être au format JPG, JPEG ou PNG</li>
                <li>Taille maximale par photo : 5MB</li>
                <li>Votre numéro de téléphone servira d'identifiant de connexion</li>
            </ul>
        </div> -->
    </div>

    <!-- Debug info (à supprimer en production) -->
    <!-- <?php if (isset($error) && !empty($error)): ?>
        <div style="margin-top: 20px; padding: 10px; background: #f0f0f0; font-size: 12px; max-width: 28rem; margin-left: auto; margin-right: auto;">
            <strong>Debug Info:</strong><br>
            Errors: <?= print_r($error, true) ?><br>
            POST: <?= print_r($_POST, true) ?><br>
            FILES: <?= print_r($_FILES, true) ?>
        </div>
    <?php endif; ?> -->
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
    
    .form-input.error {
        border-color: #dc2626;
    }
    
    .error-text {
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        display: block;
    }
    
    .help-text {
        color: #6b7280;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        display: block;
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
    
    .upload-area:hover {
        background-color: #f3f4f6;
        border-color: #f97316;
    }
    
    .upload-area.error {
        border-color: #dc2626;
        background-color: #fef2f2;
    }
    
    .upload-input {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
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
    
    .submit-btn:hover {

        background-color: #f97316;
    }
    
    .submit-btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.3);
    }
    
    .info-box {
        background-color: #f0f9ff;
        border: 1px solid #bae6fd;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-top: 1rem;
    }
    
    .info-box p {
        font-weight: 500;
        color: #0369a1;
        margin-bottom: 0.5rem;
    }
    
    .info-box ul {
        list-style-type: disc;
        margin-left: 1.5rem;
        color: #0369a1;
    }
    
    .info-box li {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
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
// Améliorer l'expérience utilisateur pour l'upload de fichiers
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