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

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password']; // Ne pas oublier de hasher le mot de passe avant de l'enregistrer dans la base de données

// Hashage du mot de passe (recommandé pour des raisons de sécurité)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Requête SQL pour insérer les données dans la base de données
$sql = "INSERT INTO connexion_admin (nom, prenom, email, username, password_hash) VALUES ('$nom', '$prenom', '$email', '$username', '$password')";

if ($connexion->query($sql) === TRUE) {
    echo "Inscription réussie.";
} else {
    echo "Erreur lors de l'inscription : " . $connexion->error;
}

// Fermeture de la connexion
$connexion->close();
?>
