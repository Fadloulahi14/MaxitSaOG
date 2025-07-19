<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - Service Commercial</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        
        .slide-in {
            animation: slideIn 0.6s ease-out;
        }
        
        .admin-gradient {
            background: linear-gradient(135deg, #f97316 100%, #ea580c 100%, #dc2626 100%);
        }
        
        .login-bg {
            background: linear-gradient(135deg, #f97316 100%, #ea580c50%, #fecaca 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }
        
        .floating-shapes::before {
            content: '';
            position: absolute;
            top: 20%;
            left: 10%;
            width: 80px;
            height: 80px;
            background: rgba(249, 115, 22, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-shapes::after {
            content: '';
            position: absolute;
            bottom: 20%;
            right: 15%;
            width: 120px;
            height: 120px;
            background: rgba(220, 38, 38, 0.1);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite reverse;
        }
        
        .input-focus:focus {
            transform: scale(1.02);
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(249, 115, 22, 0.3);
        }
    </style>
</head>
<body class="login-bg min-h-screen flex items-center justify-center p-4">
    <div class="floating-shapes"></div>
    
    <!-- Main Login Container -->
    <div class="fade-in w-full max-w-md relative z-10">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 admin-gradient rounded-3xl mb-6 shadow-2xl">
                <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
            <p class="text-gray-600 text-lg">Service Commercial</p>
        </div>
        
        <!-- Login Form -->
        <div class="glass-effect rounded-3xl p-8 shadow-2xl slide-in">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Connexion Sécurisée</h2>
                <p class="text-gray-600">Veuillez saisir vos identifiants d'administrateur</p>
            </div>
            
            <form action="admin" method="POST" class="space-y-6">
                <!-- Username Field -->
                <div class="space-y-2">
                    <label for="username" class="block text-sm font-semibold text-gray-700">
                        Nom d'utilisateur
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="username" 
                            name="username"
                            class="w-full pl-12 pr-4 py-4 border-2 border-orange-200 rounded-2xl outline-none focus:border-orange-500 transition-all duration-200 font-medium text-gray-700 input-focus"
                            placeholder="admin@commercial"
                           
                        >
                    </div>
                </div>
                
                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-gray-700">
                        Mot de passe
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <circle cx="12" cy="16" r="1"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            class="w-full pl-12 pr-4 py-4 border-2 border-orange-200 rounded-2xl outline-none focus:border-orange-500 transition-all duration-200 font-medium text-gray-700 input-focus"
                            placeholder="••••••••"
                          
                        >
                    </div>
                </div>
                
                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            id="remember" 
                            name="remember" 
                            type="checkbox" 
                            class="w-4 h-4 text-orange-600 focus:ring-orange-500 border-orange-300 rounded"
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-700 font-medium">
                            Se souvenir de moi
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-orange-600 hover:text-orange-500 transition-colors">
                            Mot de passe oublié?
                        </a>
                    </div>
                </div>
                
                <!-- Login Button -->
                <button 
                    type="submit" 
                    class="w-full admin-gradient text-white py-4 rounded-2xl font-bold text-lg hover:shadow-xl transition-all duration-200 btn-hover"
                >
                    Se connecter
                </button>
            </form>
            
            <!-- Security Notice -->
            <!-- <div class="mt-8 p-4 bg-orange-50 border border-orange-200 rounded-2xl">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-orange-500 mr-3 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-orange-800 text-sm">Sécurité</h3>
                        <p class="text-orange-700 text-sm mt-1">
                            Cet accès est réservé aux administrateurs autorisés. Toutes les connexions sont enregistrées et surveillées.
                        </p>
                    </div>
                </div>
            </div> -->
        </div>
        
        <!-- Footer -->
        <!-- <div class="text-center mt-8 text-gray-600">
            <p class="text-sm">© 2025 Service Commercial - Tous droits réservés</p>
        </div> -->
    </div>
</body>
</html>