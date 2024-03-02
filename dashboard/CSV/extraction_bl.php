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

// Requête pour récupérer toutes les données de la table
$requete = "SELECT * FROM Blacklist";

// Exécution de la requête
$resultat = $connexion->query($requete);

// Vérification s'il y a des résultats
if ($resultat->num_rows > 0) {
    // Création du fichier CSV et écriture des données
    $fichier_csv = fopen('Blacklist-plaque.csv', 'w');

    // Écriture de l'en-tête CSV avec le nom des colonnes de la table
    $entete = array();
    while ($colonne = $resultat->fetch_field()) {
        $entete[] = $colonne->name;
    }
    fputcsv($fichier_csv, $entete);

    // Écriture des données de chaque ligne
    while ($ligne = $resultat->fetch_assoc()) {
        fputcsv($fichier_csv, $ligne);
    }

    // Fermeture du fichier CSV
    fclose($fichier_csv);

    echo "Exportation de la table au format CSV réussie.";
} else {
    echo "Aucun résultat trouvé dans la table.";
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>