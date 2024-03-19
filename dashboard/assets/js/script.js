document.getElementById("ouvrirPortail").addEventListener("click", function(event) {
    // Faire une requête vers l'API
    fetch('https://e3a7f685-5f5c-4c32-a94a-e4121d430445.mock.pstmn.io/Dashboard/OuverturePortail?')
        .then(response => {
            // Vérifier si la réponse est OK (statut 200)
            if (!response.ok) {
                throw new Error('Erreur de réseau');
            }
            // Si la réponse est OK, afficher un message de succès
            alert('Portail ouvert avec succès!');
        })
        .catch(error => {
            console.error('Erreur:', error);
            // En cas d'erreur, afficher un message d'erreur
            alert('Erreur lors de l\'ouverture du portail. Veuillez réessayer plus tard.');
        });
});