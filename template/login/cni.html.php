<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche CNI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <script defer src="../../template/login/script.js"></script> -->

</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white border-2 border-orange-200 rounded-2xl p-8 hover:border-orange-500 transition-all duration-300 shadow-sm hover:shadow-lg">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-orange-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v7m5 9l-5-5m0 0l5-5m-5 5h12"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Rechercher une CNI</h2>
                <p class="text-gray-500">Saisissez le numéro de carte d'identité</p>
            </div>

            <form id="cniForm" method="POST" action="" class="space-y-6">
                <div>
                    <label for="nci" class="block text-gray-700 font-semibold mb-3">Numéro CNI</label>
                    <input 
                        type="text" 
                        id="nci" 
                        name="nci" 
                        required 
                        placeholder="Ex: 95041221001" 
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200"
                        maxlength="20"
                        pattern="[0-9]{10,20}"
                    >
                </div>
                
                <button 
                    type="submit" 
                    class="w-full bg-orange-500 text-white py-3 px-6 rounded-xl font-semibold hover:bg-orange-600 transition-colors duration-200 flex items-center justify-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Rechercher
                </button>
            </form>

        <div id="resultat" class="mt-6 text-sm text-gray-800"></div>

        </div>
    </div>
</body>
</html>

<script >
document.getElementById('cniForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const numeroCNI = document.getElementById('nci').value.trim();
    const resultat = document.getElementById('resultat');

    fetch('https://backendcnimaxit.onrender.com/api/citoyen')
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur lors de la requête !");
            }
            return response.json();
        })
        .then(data => {
            if (!data.data || data.data.length === 0) {
                resultat.innerHTML = `<div class="p-4 bg-red-100 text-red-700 rounded">Aucun citoyen trouvé.</div>`;
                return;
            }

            const citoyen = data.data.find(c => c.nci === numeroCNI);
            if (!citoyen) {
                resultat.innerHTML = `<div class="p-4 bg-red-100 text-red-700 rounded">Aucun citoyen trouvé avec ce numéro.</div>`;
                return;
            }

            resultat.innerHTML = `
                <div class="p-4 bg-green-100 rounded">
                    <p><strong>NCI:</strong> ${citoyen.nci}</p>
                    <p><strong>Nom:</strong> ${citoyen.nom}</p>
                    <p><strong>Prénom:</strong> ${citoyen.prenom}</p>
                    <p><strong>Date Naissance:</strong> ${citoyen.date_naissance}</p>
                    <p><strong>Lieu Naissance:</strong> ${citoyen.lieu_naissance}</p>
                    <img src="${citoyen.url_carte_recto}" alt="Carte Recto" class="w-48 mt-2 border">
                </div>`;
        })
        .catch(error => {
            resultat.innerHTML = `<div class="p-4 bg-red-100 text-red-700 rounded">${error.message}</div>`;
        });
});


// document.getElementById('cniForm').addEventListener('submit', function (e) {
//     e.preventDefault();
//     const numeroCNI = document.getElementById('nci').value.trim();
//     const resultat = document.getElementById('resultat');

//     fetch('https://backendcnimaxit.onrender.com/api/citoyen')
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error("Erreur lors de la requête !");
//             }
//             return response.json();
//         })
//         .then(data => {
//             const citoyen = data.data.find(c => c.nci === numeroCNI);
//             if (!citoyen) {
//                 resultat.innerHTML = `<div class="p-4 bg-red-100 text-red-700 rounded">Aucun citoyen trouvé avec ce numéro.</div>`;
//                 return;
//             }

//             // Stocker les données du citoyen dans le sessionStorage
//             sessionStorage.setItem("citoyen", JSON.stringify(citoyen));

//             // Redirection vers la page "sinscrire"
//             window.location.href = "/inscription"; // <-- adapte le chemin si besoin
//         })
//         .catch(error => {
//             resultat.innerHTML = `<div class="p-4 bg-red-100 text-red-700 rounded">${error.message}</div>`;
//         });
// });



</script>

