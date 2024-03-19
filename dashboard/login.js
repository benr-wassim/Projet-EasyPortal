document.addEventListener("DOMContentLoaded", function() {
    alert('sa marche');
    const form = document.querySelector("#form_creation_admin");

    form.addEventListener("submit", function(event) {
        
        event.preventDefault(); // Empêche l'envoi du formulaire par défaut

        // Récupération des valeurs des champs de formulaire
        const prenom = document.querySelector("#prenom").value;
        const nom = document.querySelector("#nom").value;
        const username = document.querySelector("#username").value;
        const email = document.querySelector("#email").value;
        const password = document.querySelector("#password").value;

        // Création de l'objet à envoyer
        const data = {
            prenom: prenom,
            nom: nom,
            username: username,
            email: email,
            password: password
        };

        // Envoi de la requête POST à l'API
        fetch('https://da7249d4-6fb3-41cf-8186-29452ad842a0.mock.pstmn.io/Dashboard/GestionUser/add_user', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur HTTP ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Réponse reçue :', data);
            // Réponse de l'API
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données:', error);
        });
    });
});
