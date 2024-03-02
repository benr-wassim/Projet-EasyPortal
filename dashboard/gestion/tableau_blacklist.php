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

// Requête pour récupérer toutes les données de la table "Blacklist"
$requete = "SELECT id, plaque FROM Blacklist";

// Exécution de la requête
$resultat = $connexion->query($requete);

// Vérification s'il y a des résultats
if ($resultat->num_rows > 0) {
    echo "<table border='1'>"; // Correction ici, ouverture de la balise table
    echo "<tr><th>ID</th><th>Plaque</th></tr>";
    // Affichage des données dans le tableau HTML
    while($row = $resultat->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["plaque"]."</td></tr>"; // Correction ici, fermeture des balises td
    }
    echo "</table>";
} else {
    echo "Aucun résultat trouvé dans la table 'Blacklist'.";
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>
