<?php
// Vérifie si la requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si le formulaire de création d'administrateur est soumis
    if (isset($_POST["createAdmin"])) {
        // Récupère le nouveau nom d'utilisateur
        $newUsername = $_POST["newUsername"];
        // Effectue les opérations nécessaires pour créer un nouvel administrateur
        // (par exemple, insertion dans la base de données)
        // Ici, vous devez ajouter votre propre logique de création d'administrateur
        echo "Nouvel administrateur créé : " . $newUsername;
    }
    // Vérifie si le formulaire de suppression d'administrateur est soumis
    elseif (isset($_POST["deleteAdmin"])) {
        // Récupère l'administrateur à supprimer
        $adminToDelete = $_POST["adminToDelete"];
        // Effectue les opérations nécessaires pour supprimer l'administrateur
        // (par exemple, suppression dans la base de données)
        // Ici, vous devez ajouter votre propre logique de suppression d'administrateur
        echo "Administrateur supprimé : " . $adminToDelete;
    }
}
?>
