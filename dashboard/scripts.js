// Fonction pour confirmer l'ajout à la liste des plaques autorisées
function confirmerAjout() {
    var plaque = document.getElementById("plaqueWhitelist").value;
    var username = prompt("Veuillez entrer le nom d'utilisateur :");
    if (username !== null) {
        // Si l'utilisateur a saisi un nom d'utilisateur, envoyer les données au serveur
        ajouterPlaque(username, plaque);
    }
}

// Fonction pour ajouter la plaque à la liste des plaques autorisées
function ajouterPlaque(username, plaque) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText); // Afficher la réponse du serveur
            // Recharger la page ou effectuer d'autres actions si nécessaire
            location.reload();
        }
    };
    xhttp.open("POST", "ajouter.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + username + "&plaque=" + plaque);
}

// Événement pour afficher la boîte de dialogue de confirmation lorsque le bouton est cliqué
document.getElementById("retirerBlacklistBtn").addEventListener("click", function() {
    if (confirm("Voulez-vous ajouter cette plaque à la liste des plaques autorisées?")) {
        confirmerAjout();
    }
});
