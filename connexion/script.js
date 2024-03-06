function validateForm() {
    var usernameInput = document.getElementById("username");
    var passwordInput = document.getElementById("password");
    
    // Vérifier le champ Nom d'utilisateur
    if (usernameInput.value.trim() === '') {
        usernameInput.classList.add('invalid-input');
    } else {
        usernameInput.classList.remove('invalid-input');
        usernameInput.classList.add('valid-input');
    }

    // Vérifier le champ Mot de Passe
    if (passwordInput.value.trim() === '') {
        passwordInput.classList.add('invalid-input');
    } else {
        passwordInput.classList.remove('invalid-input');
        passwordInput.classList.add('valid-input');
    }

    // Vérifier si tous les champs sont remplis
    if (usernameInput.value.trim() === '' || passwordInput.value.trim() === '') {
        alert("Veuillez remplir tous les champs");
        return false; // Empêche la soumission du formulaire
    } else {
        // Simuler l'envoi des données à une URL avec fetch
        fetch('https://da7249d4-6fb3-41cf-8186-29452ad842a0.mock.pstmn.io/connexion', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                username: usernameInput.value,
                password_hash: passwordInput.value
            }),
        })
        .then(response => response.json()) // Convertir la réponse en JSON
        .then(data => {
            console.log("Données reçues:", data); // Vérifier les données reçues dans la console
            if (data && data.administrateur) {
                var found = data.administrateur.some(user => user.username === usernameInput.value && user.password_hash === passwordInput.value);
                if (found) {
                    alert("Connexion réussie");
                    // Redirection vers une autre page
                    // window.location.href = "http://localhost:8888/BTSSNIR2/informatique/projet/Projet-EasyPortal/dashboard/dashboard.html";
                } else {
                    alert("Identifiants incorrects");
                }
            } else {
                alert("Erreur: les données de l'administrateur sont manquantes ou incorrectes");
            }
        })
        .catch(error => {
            console.error('Erreur lors de l\'envoi de la requête:', error);
            // Gérer les erreurs ici
        });

        return false; // Empêche la soumission du formulaire
    }
}

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("form-login").addEventListener("submit", function(event) {
        event.preventDefault(); // Empêche la soumission par défaut du formulaire
    });
});
