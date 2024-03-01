<?php
// Inclusion des paramètres de connexion à la base de données
include 'config.php';

// Vérification si le paramètre 'username' est présent dans la requête
if (isset($_POST['username'])) {
    // Récupération du nom d'utilisateur à supprimer
    $username = $_POST['username'];

    // Requête SQL pour supprimer l'administrateur avec le nom d'utilisateur spécifié
    $requete = "DELETE FROM connexion_admin WHERE username = '$username'";

    // Exécution de la requête
    if ($connexion->query($requete) === TRUE) {
        echo "L'administrateur a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'administrateur : " . $connexion->error;
    }
} else {
    echo "Le paramètre 'username' n'a pas été spécifié dans la requête.";
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>
