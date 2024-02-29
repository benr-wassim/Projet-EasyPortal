$(document).ready(function() {
    // Fonction pour charger la liste des administrateurs existants dans le formulaire de suppression
    function loadAdminsForDeletion() {
        $.ajax({
            url: 'get_admins.php', // Fichier PHP pour récupérer la liste des administrateurs
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Remplit le select avec les options récupérées
                $('#adminToDelete').empty();
                $.each(data, function(index, item) {
                    $('#adminToDelete').append($('<option>', {
                        value: item.username,
                        text: item.username
                    }));
                });
            }
        });
    }

    // Appel de la fonction pour charger la liste des administrateurs existants lors du chargement de la page
    loadAdminsForDeletion();

    // Soumission du formulaire pour créer un nouvel administrateur
    $('#createAdminForm').submit(function(event) {
        event.preventDefault(); // Empêche le rechargement de la page
        var formData = $(this).serialize(); // Récupère les données du formulaire
        $.post('admin_management.php', formData, function(response) {
            $('#message').html(response); // Affiche le message de succès ou d'erreur
            loadAdminsForDeletion(); // Recharge la liste des administrateurs dans le formulaire de suppression
        });
    });

    // Soumission du formulaire pour supprimer un administrateur
    $('#deleteAdminForm').submit(function(event) {
        event.preventDefault(); // Empêche le rechargement de la page
        var formData = $(this).serialize(); // Récupère les données du formulaire
        $.post('admin_management.php', formData, function(response) {
            $('#message').html(response); // Affiche le message de succès ou d'erreur
            loadAdminsForDeletion(); // Recharge la liste des administrateurs dans le formulaire de suppression
        });
    });
});
