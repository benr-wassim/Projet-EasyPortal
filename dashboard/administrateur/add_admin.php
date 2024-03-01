<?php
// Informations de connexion à la base de données
$serveur = "localhost"; // Adresse du serveur MySQL
$utilisateur = "root"; // Nom d'utilisateur MySQL
$motdepasse = "root"; // Mot de passe MySQL
$base_de_donnees = "EasyPortal"; // Nom de la base de données

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Récupération des données du formulaire
$username = $_POST['username'];
$password = $_POST['password'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];

// Hashage du mot de passe
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Requête SQL pour insérer les données dans la table 'connexion_admin'
$sql = "INSERT INTO connexion_admin (username, password_hash, nom, prenom, email) 
        VALUES ('$username', '$password_hash', '$nom', '$prenom', '$email')";

if ($connexion->query($sql) === TRUE) {
    echo "Nouvel administrateur ajouté avec succès.";
} else {
    echo "Erreur lors de l'ajout de l'administrateur : " . $connexion->error;
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>
