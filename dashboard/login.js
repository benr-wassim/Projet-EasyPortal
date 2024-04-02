document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("#form_creation_admin");

    form.addEventListener("submit", function(event) {
        
        event.preventDefault(); // Empêche l'envoi du formulaire par défaut

        // Récupération des valeurs des champs de formulaire
        const prenom = document.querySelector("#prenom").value;
        const nom = document.querySelector("#nom").value;
        const username = document.querySelector("#username").value;
        const email = document.querySelector("#email").value;
        const password = document.querySelector("#password").value;

        console.log("juste avant de montre les data");
        console.log('prenom:', prenom);
        console.log('nom:', nom);
        console.log('username:', username);
        console.log('email:', email);
        console.log('password:', password);

        // Création de l'objet à envoyer
        const data = {
            "prenom": prenom,
            "nom": nom,
            "username": username,
            "email": email,
            "password": password
        };

        // Envoi de la requête POST à l'API
        fetch('https://da7249d4-6fb3-41cf-8186-29452ad842a0.mock.pstmn.io/Dashboard/GestionUser/ajouter_administrateur', {
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
            alert("l'utilisateur a bien été ajouté ! ");
            // Réponse de l'API
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données:', error);
        });
    });
});
