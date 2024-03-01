<?php
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "root";
$base_de_donnees = "EasyPortal";

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Vérification si une plaque a été soumise dans le formulaire
if(isset($_POST['plaque'])) {
    // Récupération de la plaque d'immatriculation saisie par l'utilisateur
    $plaque = $_POST['plaque'];

    // Requête d'insertion dans la table 'blacklist'
    $requete_insertion = "INSERT INTO blacklist (plaque) VALUES ('$plaque')";

    // Exécution de la requête
    if ($connexion->query($requete_insertion) === TRUE) {
        header("Location: ../dashboard/dashboard.html");
    } else {
        echo "Erreur lors de l'ajout de la plaque à la liste noire : " . $connexion->error;
    }
} else {
    echo "Veuillez fournir une plaque d'immatriculation.";
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>
