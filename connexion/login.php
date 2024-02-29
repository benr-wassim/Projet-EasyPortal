<?php
ini_set('display_errors', 'on');

// Connexion à la base de données
$servername = "localhost"; // Adresse du serveur MySQL
$username = "root"; // Nom d'utilisateur MySQL
$password = "root"; // Mot de passe MySQL
$dbname = "EasyPortal"; // Nom de la base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des données saisies dans le formulaire
$user = $_POST['username'];
$pass = $_POST['password'];

// Requête SQL pour vérifier les informations d'identification
$sql = "SELECT * FROM connexion_admin WHERE username='$user' AND password_hash ='$pass'";
$result = $conn->query($sql);

// Vérification si l'utilisateur existe dans la base de données
if ($result->num_rows > 0) {
    // L'utilisateur existe, redirigez-le vers une page de succès ou effectuez d'autres actions nécessaires
    echo "Connexion réussie !";
    header("Location: ../dashboard/dashboard.html");
} else {
    // L'utilisateur n'existe pas ou les informations d'identification sont incorrectes
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}

$conn->close();
?>