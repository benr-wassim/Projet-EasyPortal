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
        // Adapter l'URL en fonction des identifiants
        var url = `https://da7249d4-6fb3-41cf-8186-29452ad842a0.mock.pstmn.io/connexion/administrateur?username=${encodeURIComponent(usernameInput.value)}&password=${encodeURIComponent(passwordInput.value)}`;
   
        // Envoyer la requête à l'URL adaptée avec fetch
        fetch(url)
            .then(response => response.json()) // Convertir la réponse en JSON
            .then(data => {
                console.log("Données reçues:", data); // Vérifier les données reçues dans la console
                if (data && data.administrateur) {
                    var found = data.administrateur.some(user => user.username === usernameInput.value && user.password_hash === passwordInput.value);
                    if (found) {
                        // Redirection vers une autre page
                        //window.location.href = "http://localhost:8888/MAMP/htdocs//BTSSNIR2/informatique/projet/Projet-EasyPortal/dashboard/index.html";
                        window.location.href = "../../dashboard/index.html";
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

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("form-login").addEventListener("submit", function (event) {
        event.preventDefault(); // Empêche la soumission par défaut du formulaire
    });
});