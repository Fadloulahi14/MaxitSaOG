<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Client</title>
</head>
<body>
    <div class="container">
        <h1 class="title">Connexion Client</h1>
        <p class="subtitle">Connectez-vous avec votre numéro de téléphone</p>
        
        <?php if (isset($error['global'])): ?>
            <div class="error-message">
                <?= htmlspecialchars($error['global']) ?>
            </div>
        <?php endif; ?>
        
        <form action="/create" method="post">
            <div class="form-group">
                <label for="telephone" class="form-label">Numéro de téléphone:</label>
                <input 
                    type="tel" 
                    id="telephone" 
                    name="telephone" 
                    class="form-input <?= isset($error['telephone']) ? 'error' : '' ?>"
                    placeholder="Ex: 778012731"
                    value=""
                   
                  
                >
                <?php if (isset($error['telephone'])): ?>
                    <span class="error-text"><?= htmlspecialchars($error['telephone']) ?></span>
                <?php endif; ?>
                <small class="help-text">Entrez votre numéro sans indicatif (9 chiffres)</small>
            </div>

            <button type="submit" class="submit-btn">
                Se Connecter
            </button>
        </form>
        
        <div class="links">
            <a href="inscription" class="signup-link">Pas encore de compte ? S'inscrire</a>
            <!-- <a href="/login" class="admin-link">Connexion Agent</a> -->
        </div>
    </div>

    <!-- Debug info (à supprimer en production) -->
    <!-- <div style="margin-top: 20px; padding: 10px; background: #f0f0f0; font-size: 12px; max-width: 32rem;">
        <strong>Debug Info:</strong><br>
        POST data: <?= print_r($_POST, true) ?><br>
        Errors: <?= isset($error) ? print_r($error, true) : 'Aucune erreur' ?>
    </div> -->
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
        border: 2px solid #fed7aa;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        padding: 3rem 2rem;
        width: 100%;
        max-width: 32rem;
        text-align: center;
    }
    
    .title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 1rem;
    }
    
    .subtitle {
        font-size: 1rem;
        color: #6b7280;
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
        margin-bottom: 2rem;
        text-align: left;
    }
    
    .form-label {
        display: block;
        font-size: 1rem;
        font-weight: 500;
        color: black;
        margin-bottom: 0.5rem;
    }
    
    .form-input {
        width: 100%;
        padding: 1rem 1.5rem;
        border: 2px solid #fed7aa;
        border-radius: 9999px;
        outline: none;
        font-size: 1rem;
        color: black;
        transition: border-color 0.3s ease;
        background-color: white;
    }
    
    .form-input:focus {
        border-color: #f97316;
    }
    
    .form-input.error {
        border-color: #dc2626;
    }
    
    .form-input::placeholder {
        color: #9ca3af;
    }
    
    .error-text {
        color: #dc2626;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: block;
    }
    
    .help-text {
        color: #6b7280;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: block;
    }
    
    .submit-btn {
        width: 100%;
        max-width: 18rem;
        background-color: #fb923c;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 1rem 2rem;
        border: none;
        border-radius: 9999px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin: 0 auto 2rem auto;
        display: block;
    }
    
    .submit-btn:hover {
        background-color: #f97316;
    }
    
    .submit-btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.3);
    }
    
    .links {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: center;
    }
    
    .signup-link, .admin-link {
        color: #f97316;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    
    .signup-link:hover, .admin-link:hover {
        color: #ea580c;
    }
    
    @media (max-width: 640px) {
        .container {
            padding: 2rem 1.5rem;
        }
        
        .title {
            font-size: 1.25rem;
        }
    }
</style>