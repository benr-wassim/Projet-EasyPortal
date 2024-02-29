<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "root";
$base_de_donnees = "EasyPortal";

$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Requête pour récupérer toutes les données de la table "plaque" avec la colonne "username"
$requete = "SELECT id, username, plaque, plaque_2 FROM plaque";

// Exécution de la requête
$resultat = $connexion->query($requete);

// Vérification s'il y a des résultats
if ($resultat->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Username</th><th>Plaque</th><th>Plaque 2</th></tr>";
    // Affichage des données dans le tableau HTML
    while($row = $resultat->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["username"]."</td><td>".$row["plaque"]."</td><td>".$row["plaque_2"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "Aucun résultat trouvé dans la table 'plaque'.";
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>
