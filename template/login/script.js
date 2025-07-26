console.log('response');
document.getElementById('cniForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const numeroCNI = document.getElementById('nci').value.trim();
    const resultat = document.getElementById('resultat');

    fetch(`https://backendcnimaxit.onrender.com/api/citoyen/${numeroCNI}`)
        .then(response => {
            if (!response.ok) {
                throw new Error("CNI introuvable !");
            }
            return response.json();
            
        })
        .then(data => {
            resultat.innerHTML = `
                <div class="p-4 bg-green-100 rounded">
                    <p><strong>NCI:</strong> ${data.nci}</p>
                    <p><strong>Nom:</strong> ${data.nom}</p>
                    <p><strong>Prénom:</strong> ${data.prenom}</p>
                    <p><strong>Date Naissance:</strong> ${data.date_naissance}</p>
                    <p><strong>Lieu Naissance:</strong> ${data.lieu_naissance}</p>
                    <img src="${data.url_carte_recto}" alt="Carte Recto" class="w-48 mt-2 border">
                </div>`;
        })
        .catch(error => {
            resultat.innerHTML = `<div class="p-4 bg-red-100 text-red-700 rounded">${error.message}</div>`;
        });
});