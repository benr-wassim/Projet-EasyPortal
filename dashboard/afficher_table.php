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

// Requête SQL pour sélectionner toutes les données de la table
$sql = "SELECT * FROM logs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Création du tableau HTML pour afficher les données
    echo "<table border='1'>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $key => $value) {
            echo "<td>".$value."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 résultats";
}

// Fermeture de la connexion
$conn->close();
?>
