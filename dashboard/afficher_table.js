function afficherTable() {
    // Création d'une requête HTTP GET pour récupérer les données de la table
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Affichage des données dans le conteneur
            document.getElementById("tableContainer").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "afficher_table.php", true);
    xhttp.send();
}

// Événement pour appeler la fonction afficherTable() lorsque le bouton est cliqué
document.getElementById("afficherTableBtn").addEventListener("click", afficherTable);
