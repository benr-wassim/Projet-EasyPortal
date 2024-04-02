// Sélectionner le bouton de suppression
var deleteButton = document.getElementById("deleteButton");

// Ajouter un écouteur d'événement au clic sur le bouton
deleteButton.addEventListener("click", function() {
    // Sélectionner le champ de saisie utilisateur
    var userInput = document.getElementById("userInput");

    // Récupérer la valeur saisie par l'utilisateur
    var plaqueImmatriculation = userInput.value.trim();

    // Vérifier si le champ de saisie est vide
    if (plaqueImmatriculation === "") {
        alert("Veuillez saisir une plaque d'immatriculation avant de supprimer.");
    } else {
        // Si le champ n'est pas vide, configurer les options de la requête DELETE
        var options = {
            method: 'DELETE'
        };

        // Envoyer la requête DELETE à l'API
        fetch('https://da7249d4-6fb3-41cf-8186-29452ad842a0.mock.pstmn.io/Dashboard/GestionPlaque/supprimer_plaque', options)
            .then(response => {
                // Vérifier si la réponse est OK (statut 200)
                if (!response.ok) {
                    throw new Error('Erreur de réseau');
                }
                // Si la réponse est OK, afficher un message de succès
                alert('Plaque d\'immatriculation supprimée avec succès!');
            })
            .catch(error => {
                console.error('Erreur:', error);
                // En cas d'erreur, afficher un message d'erreur
                alert('Erreur lors de la suppression de la plaque d\'immatriculation. Veuillez réessayer plus tard.');
            });
    }
});
