function afficherTableau() {
    fetch('https://da7249d4-6fb3-41cf-8186-29452ad842a0.mock.pstmn.io/Dashboard/GestionUser/liste_user')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('tbody');
            tbody.innerHTML = ""; // Effacer le contenu précédent du tableau

            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.username}</td>
                    <td><button onclick="supprimer_admin('${item.username}')">Supprimer</button></td>
                `;
                tbody.appendChild(row);
            });

            document.getElementById("tableauContainer").style.display = "block";
        })
        .catch(error => console.error('Erreur lors de la récupération des données:', error));

    var tableauContainer = document.getElementById("tableauContainer");
    var boutonSupprimer = document.getElementById("boutonSupprimer");
    if (tableauContainer.style.display === "none") {
        tableauContainer.style.display = "block";
        boutonSupprimer.innerHTML = "<strong>Cacher tableau</strong>";
    } else {
        tableauContainer.style.display = "none";
        boutonSupprimer.innerHTML = "<strong>Supprimer administrateur</strong>";
    }
}

function supprimer_admin(username) {
    // Encodez l'username pour vous assurer qu'il est correctement inclus dans l'URL
    const encodedUsername = encodeURIComponent(username);

    fetch(`https://da7249d4-6fb3-41cf-8186-29452ad842a0.mock.pstmn.io/Dashboard/GestionUser/supprimer_admin?username=${encodedUsername}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username: username })
    })
    .then(response => {
        if (response.ok) {
            alert('Utilisateur supprimé avec succès');
            // Rafraîchir le tableau après la suppression
            afficherTableau();
        } else {
            alert('Erreur lors de la suppression de l\'utilisateur');
        }
    })
    .catch(error => console.error('Erreur lors de la suppression de l\'utilisateur:', error));
}
