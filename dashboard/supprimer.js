// Sélectionner le bouton de suppression
var deleteButton = document.getElementById("deleteButton");

// Ajouter un écouteur d'événement au clic sur le bouton
deleteButton.addEventListener("click", function() {
    // Sélectionner le champ de saisie utilisateur
    var userInput = document.getElementById("userInput");

    // Vérifier si le champ de saisie est vide
    if (userInput.value.trim() === "") {
        alert("Veuillez saisir une valeur avant de supprimer.");
    } else {
        // Si le champ n'est pas vide, vous pouvez procéder à la suppression ou à toute autre action souhaitée
        console.log("La valeur saisie est : " + userInput.value);
        // Ajoutez ici le code pour effectuer l'action de suppression
    }
});
