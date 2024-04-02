function exportToCSV() {
    // Appeler le fichier PHP pour extraire le CSV
    fetch('CSV/export.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.blob();
    })
    .then(blob => {
        // Créer un lien temporaire pour télécharger le fichier CSV
        const url = window.URL.createObjectURL(new Blob([blob]));
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = 'export.csv';
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
    })
    .catch(error => {
        console.error('There has been a problem with your fetch operation:', error);
    });
}

function exportNonAuthorizedPlatesToCSV() {
    // Appeler le fichier PHP pour extraire le CSV des plaques non autorisées
    fetch('CSV/export_non_autorise.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.blob();
    })
    .then(blob => {
        // Créer un lien temporaire pour télécharger le fichier CSV
        const url = window.URL.createObjectURL(new Blob([blob]));
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = 'plaque-non-autorise.csv';
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
    })
    .catch(error => {
        console.error('There has been a problem with your fetch operation:', error);
    });
}

function importPlaque() {
    // Écouter les changements sur le champ d'entrée de type file
    document.getElementById('plaque_file').addEventListener('change', function(event) {
        var file = event.target.files[0];
        if (file) {
            // Afficher une alerte avec le nom du fichier sélectionné
            alert("Fichier sélectionné : " + file.name);

            // Créer un objet FormData et y ajouter le fichier sélectionné
            var formData = new FormData();
            formData.append('plaque_file', file);

            // Envoyer une requête AJAX vers le fichier PHP pour le traitement
            fetch('CSV/import_plaque.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                // Afficher la réponse de la requête (peut être modifié en fonction de votre besoin)
                alert(data);
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
        }
    });

    // Déclencher le sélecteur de fichier lorsque l'utilisateur clique sur le bouton
    document.getElementById('plaque_file').click();
}
