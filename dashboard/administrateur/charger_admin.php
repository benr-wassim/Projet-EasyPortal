<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$database = "EasyPortal";

$conn = new mysqli($servername, $username, $password, $database);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Requête SQL pour sélectionner toutes les données de la table connexion_admin
$sql = "SELECT * FROM connexion_admin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Création du tableau HTML pour afficher les données
    echo "<table border='10'>";
    echo "<tr><th>Username</th><th>Password Hash</th><th>Nom</th><th>Prénom</th><th>Email</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["username"]."</td>";
        echo "<td>".$row["password_hash"]."</td>";
        echo "<td>".$row["nom"]."</td>";
        echo "<td>".$row["prenom"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 résultats";
}

// Fermeture de la connexion
$conn->close();
?>
