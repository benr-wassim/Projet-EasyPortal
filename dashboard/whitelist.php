<?php
// Informations de connexion à la base de données
$serveur = "localhost"; // ou l'adresse IP de votre serveur MySQL
$utilisateur = "root"; // votre nom d'utilisateur MySQL
$motdepasse = "root"; // votre mot de passe MySQL
$base_de_donnees = "EasyPortal"; // le nom de votre base de données

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Récupération de la plaque saisie dans le formulaire
$plaque = $_POST['plaque'];

// Requête de suppression
$requete_suppression = "DELETE FROM Blacklist WHERE plaque = '$plaque' ";

// Exécution de la requête de suppression
if ($connexion->query($requete_suppression) === TRUE) {
    echo "La plaque a été supprimée de la blacklist avec succès.";

    // Requête SQL pour ajouter la plaque à la table plaques
    $sql_insert = "INSERT INTO plaques (plaque) VALUES ('$plaque')";

    if ($connexion->query($sql_insert) === TRUE) {
        echo "Plaque ajoutée à la liste des plaques avec succès.";
        header("Location: ../dashboard/dashboard.html");
    } else {
        echo "Erreur lors de l'ajout de la plaque à la liste des plaques : " . $connexion->error;
    }

} else {
    echo "Erreur lors de la suppression de la plaque : " . $connexion->error;
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>
