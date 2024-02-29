<?php
// Connexion à la base de données
$servername = "localhost"; // Adresse du serveur MySQL
$username = "root"; // Nom d'utilisateur MySQL
$password = "root"; // Mot de passe MySQL
$dbname = "EasyPortal"; // Nom de la base de données

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des données saisies dans le formulaire
$username = $_POST['username'];
$plaque = $_POST['plaque'];
$plaque2 = isset($_POST['plaque2']) ? $_POST['plaque2'] : null;

// Requête SQL pour insérer les données dans la base de données
$sql = "INSERT INTO plaque (username, plaque, plaque_2) VALUES ('$username', '$plaque', ";

// Vérifier si la plaque_2 est définie
if ($plaque2 !== null) {
    // Si la plaque_2 est définie, ajoutez-la à la requête SQL
    $sql .= "'$plaque2'";
} else {
    // Si la plaque_2 n'est pas définie, insérez NULL dans la colonne plaque_2 de la base de données
    $sql .= "NULL";
}
$sql .= ")";

if ($conn->query($sql) === TRUE) {
    echo "Données insérées avec succès.";
    header("Location: ../dashboard/dashboard.html");
} else {
    echo "Erreur lors de l'insertion des données: " . $conn->error;
}

// Fermeture de la connexion
$conn->close();
?>