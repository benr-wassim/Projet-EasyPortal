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
        .then(response => response.json())
        .then(data => {
            // Vérifie si le JSON contient la propriété "administrateur"
            if (data && data.administrateur) {
                // Récupère la liste des administrateurs
                const administrateurs = data.administrateur;
                // Vérifie si un administrateur avec les identifiants donnés existe
                const found = administrateurs.some(admin => admin.username === usernameInput.value && admin.password === passwordInput.value);
                if (found) {
                    // Redirige vers la page de tableau de bord
                    window.location.href = "../../dashboard/index.html";
                } else {
                    // Affiche un message d'erreur si les identifiants sont incorrects
                    alert("Identifiants incorrects");
                }
            } else {
                // Affiche un message d'erreur si la propriété "administrateur" est manquante dans le JSON
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
