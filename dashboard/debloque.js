// Sélectionner le bouton "Débloquer"
var unlockButton = document.getElementById("bouton_debloquer");

// Ajouter un écouteur d'événement au clic sur le bouton
unlockButton.addEventListener("click", function() {
    // Sélectionner le champ de saisie utilisateur
    var userInput = document.getElementById("input_debloquer");

    // Récupérer la valeur saisie par l'utilisateur
    var plaqueImmatriculation = userInput.value.trim();

    // Vérifier si le champ de saisie est vide
    if (plaqueImmatriculation === "") {
        alert("Veuillez saisir une plaque d'immatriculation avant de débloquer.");
    } else {
        // Créer un objet de données à envoyer dans la requête POST
        var data = { plaque: plaqueImmatriculation };

        // Configurer les options de la requête POST
        var options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json' // Indiquer au serveur que le corps de la requête est au format JSON
            },
            body: JSON.stringify(data) // Convertir les données en format JSON et les inclure dans le corps de la requête
        };

        // Envoyer la requête POST à l'API
        fetch('https://da7249d4-6fb3-41cf-8186-29452ad842a0.mock.pstmn.io/Dashboard/GestionPlaque/debloquer_plaque', options)
            .then(response => {
                // Vérifier si la réponse est OK (statut 200)
                if (!response.ok) {
                    throw new Error('Erreur de réseau');
                }
                // Si la réponse est OK, afficher un message de succès
                alert('Plaque d\'immatriculation débloquée avec succès!');
            })
            .catch(error => {
                console.error('Erreur:', error);
                // En cas d'erreur, afficher un message d'erreur
                alert('Erreur lors du déblocage de la plaque d\'immatriculation. Veuillez réessayer plus tard.');
            });
    }
});
