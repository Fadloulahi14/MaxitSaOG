 <header class="bg-dark-gray border-b border-gray-700 px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 bg-green-accent rounded-full flex items-center justify-center">
                    <span class="text-xs font-bold text-black">⚗</span>
                </div>
                <h1 class="text-lg font-semibold">Fadloulahi</h1>
            </div>
            <nav class="flex space-x-8 items-center">
                <a href="<?php $url ?>store" class="text-gray-300 hover:text-white">Dashboard</a>
                <a href="<?php $url ?>login" class="text-white font-semibold">Commandes</a>
                <a href="<?php $url ?>store" class="text-gray-300 hover:text-white">Clients</a>
                <a href="<?php $url ?>create" class="text-gray-300 hover:text-white">Produits</a>
                <div class="w-8 h-8 bg-gray-600 rounded-full"></div>

                <a href="<?php $url ?>logout" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition duration-200">
                     Déconnexion
                </a>
            </nav>
        </div>
    </header>

    <?php require_once '../template/layout/partial/header.php'; ?> 