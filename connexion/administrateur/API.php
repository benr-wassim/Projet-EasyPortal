<?php
// Convert $_POST array to JSON string
//$json_response = json_encode($_POST);

// Send JSON response to the client
//echo $json_response;


// Configuration de la base de données
$servername = "51.210.151.13";
$username = "easyportal";
$password = "Easyportal2024!";
$database = "easyportal2024";

// Connexion à la base de données avec PDO
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Définition du mode d'erreur PDO sur Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher l'erreur
    die(json_encode(array('error' => 'Erreur de connexion à la base de données : ' . $e->getMessage())));
}

// Récupération de l'action à effectuer
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Traitement en fonction de l'action
switch ($action) {
    case 'connexion_administrateur':
        // Récupération des paramètres
        $utilisateur = isset($_GET['utilisateur']) ? $_GET['utilisateur'] : '';
        $password = isset($_GET['password']) ? $_GET['password'] : '';
        // Requête SQL préparée pour vérifier l'utilisateur et le mot de passe
        $query = "SELECT * FROM Administrateur WHERE utilisateur = ? AND password = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$utilisateur, $password]);

        // Vérification du résultat
        if ($stmt->rowCount() > 0) {
            // Utilisateur trouvé, envoi d'une réponse JSON
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $response = array(
                'utilisateur' => $row['utilisateur'],
                'password' => $row['password']
            );
            echo json_encode($response);
            break;
        } else {
            // Utilisateur non trouvé
            echo json_encode(array('message' => 'Identifiants incorrects'));
        }
        break;

    case 'connexion_utilisateur':
        // Récupération des paramètres
        $utilisateur = isset($_GET['utilisateur']) ? $_GET['utilisateur'] : '';
        $password = isset($_GET['password']) ? $_GET['password'] : '';
        // Requête SQL préparée pour vérifier l'utilisateur et le mot de passe
        $query = "SELECT * FROM Utilisateur WHERE utilisateur = ? AND password = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$utilisateur, $password]);

        // Vérification du résultat
        if ($stmt->rowCount() > 0) {
            // Utilisateur trouvé, envoi d'une réponse JSON
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $response = array(
                'utilisateur' => $row['utilisateur'],
                'password' => $row['password']
            );
            echo json_encode($response);
        } else {
            // Utilisateur non trouvé
            echo json_encode(array('message' => 'Identifiants incorrects'));
        }
        break;

        case 'creation_administrateur':
            // Récupérer le contenu JSON de la requête
            $json_data = file_get_contents('php://input');
                        
            // Décoder le JSON en un tableau associatif
            $data = json_decode($json_data, true);
        
            // Récupérer les identifiants 
            $utilisateur = isset($data['utilisateur']) ? $data['utilisateur'] : '';
            $password = isset($data['password']) ? $data['password'] : '';
            $nom = isset($data['nom']) ? $data['nom'] : '';
            $prenom = isset($data['prenom']) ? $data['prenom'] : '';
            $mail = isset($data['mail']) ? $data['mail'] : '';
        
            // Requête SQL préparée pour insérer un nouvel administrateur
            $query = "INSERT INTO Administrateur (utilisateur, password, nom, prenom, mail) VALUES (:utilisateur, :password, :nom, :prenom, :mail)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':utilisateur', $utilisateur, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();
        
            // Vérification du résultat
            if ($stmt->rowCount() > 0) {
                // Renvoi d'une réponse JSON avec les détails de l'administrateur créé
                $response = array(
                    'utilisateur' => $utilisateur,
                    'password' => $password,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'mail' => $mail
                );
                echo json_encode($response);
            } else {
                // En cas d'échec de l'insertion
                echo json_encode(array('message' => 'Erreur lors de la création de l\'administrateur'));
            }
            break;
                    
    case 'creation_utilisateur':
        // Récupérer les identifiants 
        $utilisateur = isset($_POST['utilisateur']) ? $_POST['utilisateur'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
        $mail = isset($_POST['mail']) ? $_POST['mail'] : '';

        // Requête SQL préparée pour insérer un nouvel utilisateur
        $query = "INSERT INTO Utilisateur (utilisateur, password, nom, prenom, mail) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$utilisateur, $password, $nom, $prenom, $mail]);

        // Vérification du résultat
        if ($stmt->rowCount() > 0) {
            // Renvoi d'une réponse JSON avec les détails de l'utilisateur créé
            $response = array(
                'utilisateur' => $utilisateur,
                'password' => $password,
                'nom' => $nom,
                'prenom' => $prenom,
                'mail' => $mail
            );
            echo json_encode($response);
        } else {
            // En cas d'échec de l'insertion
            echo json_encode(array('message' => 'Erreur lors de la création de l\'utilisateur'));
        }
        break;
        
        case 'ajouter_plaque':
            // Récupérer le contenu JSON de la requête
            $json_data = file_get_contents('php://input');
            // Décoder le JSON en un tableau associatif
            $data = json_decode($json_data, true);
        
            // Récupérer les paramètres de la requête
            $utilisateur = isset($data['username']) ? $data['username'] : null;
            $numeroPlaque = isset($data['plaque']) ? $data['plaque'] : null;
        
            // Vérifier si les paramètres requis sont présents
            
                // Requête pour récupérer l'IdUtilisateur
                $sql = "SELECT IdUtilisateur FROM Utilisateur WHERE utilisateur = :utilisateur";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':utilisateur', $utilisateur, PDO::PARAM_STR);
                $stmt->execute();

                // Vérifier si un utilisateur correspondant a été trouvé
                $idUtilisateur = $stmt->fetchColumn();
                if (!$idUtilisateur) {
                    $response['error'] = "Utilisateur non trouvé dans la base de données.";
                } else {
                    // Requête pour insérer le numéro de plaque avec l'IdUtilisateur correspondant
                    $sqlInsert = "INSERT INTO Plaque (IdUtilisateur, numeroPlaque) VALUES (:idUtilisateur, :numeroPlaque)";
                    $stmtInsert = $pdo->prepare($sqlInsert);
                    $stmtInsert->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
                    $stmtInsert->bindParam(':numeroPlaque', $numeroPlaque, PDO::PARAM_STR);
        
                    // Exécuter la requête d'insertion
                    try {
                        $stmtInsert->execute();
                        $response['success'] = "Numéro de plaque inséré avec succès.";
                    } catch (PDOException $e) {
                        $response['error'] = "Erreur lors de l'insertion du numéro de plaque : " . $e->getMessage();
                    }
                }
            // Envoyer la réponse JSON
            echo json_encode($response);
            break;
        
            case 'supprimer_plaque':
                // Récupérer le contenu JSON de la requête
                $json_data = file_get_contents('php://input');
            
                // Décoder le JSON en un tableau associatif
                $data = json_decode($json_data, true);
            
                // Récupérer le numéro de plaque à supprimer
                $numeroPlaque = isset($data['numeroPlaque']) ? $data['numeroPlaque'] : '';
            
                // Votre code pour supprimer une plaque
                // Exemple de suppression dans la base de données (à adapter selon votre structure de base de données)
                $query = "DELETE FROM Plaque WHERE numeroPlaque = :numeroPlaque";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':numeroPlaque', $numeroPlaque, PDO::PARAM_STR);
                $stmt->execute();
            
                $response = array(); // Initialisation de la variable $response
            
                if ($stmt->rowCount() > 0) {
                    // Si la suppression s'est bien passée, retourner le numéro de plaque supprimé
                    $response = array('numeroPlaque' => $numeroPlaque);
                } else {
                    // En cas d'échec de la suppression, retourner un message d'erreur
                    $response = array('message' => 'Erreur lors de la suppression de la plaque');
                }
            
                // Envoyer la réponse JSON
                echo json_encode($response);
                break;
            
                case 'bloquer_plaque':
                    // Récupérer le contenu JSON de la requête
                    $json_data = file_get_contents('php://input');
                    
                    // Décoder le JSON en un tableau associatif
                    $data = json_decode($json_data, true);
                
                    // Récupérer le numéro de plaque à bloquer
                    $numeroPlaque = isset($data['plaque']) ? $data['plaque'] : '';
                
                    // Votre code pour bloquer une plaque
                    // Exemple de mise à jour dans la base de données (à adapter selon votre structure de base de données)
                    $query = "UPDATE Plaque SET status_blacklist = 'oui' WHERE numeroPlaque = :numeroPlaque";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':numeroPlaque', $numeroPlaque, PDO::PARAM_STR);
                    $stmt->execute();
                
                    $response = array(); // Initialisation de la variable $response
                
                    if ($stmt->rowCount() > 0) {
                        // Si la mise à jour s'est bien passée, retourner le numéro de plaque bloquée
                        $response = array('numeroPlaque' => $numeroPlaque, 'status_blacklist' => 'oui');
                    } else {
                        // En cas d'échec de la mise à jour, retourner un message d'erreur
                        $response = array('message' => 'Erreur lors du blocage de la plaque');
                    }
                
                    // Envoyer la réponse JSON
                    echo json_encode($response);
                    break;
                

    case 'debloquer_plaque':
                    // Récupérer le contenu JSON de la requête
                    $json_data = file_get_contents('php://input');
                    
                    // Décoder le JSON en un tableau associatif
                    $data = json_decode($json_data, true);
                
                    // Récupérer le numéro de plaque à bloquer
                    $numeroPlaque = isset($data['plaque']) ? $data['plaque'] : '';

        // Votre code pour débloquer une plaque
        // Exemple de mise à jour dans la base de données (à adapter selon votre structure de base de données)
        $query = "UPDATE Plaque SET status_blacklist = 'non' WHERE numeroPlaque = :numeroPlaque";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':numeroPlaque', $numeroPlaque, PDO::PARAM_STR);
        $stmt->execute();

        $response = array(); // Initialisation de la variable $response

        if ($stmt->rowCount() > 0) {
            $response = array('numeroPlaque' => $numeroPlaque, 'status_blacklist' => 'non');
        } else {
            $response = array('message' => 'Erreur lors du déblocage de la plaque');
        }

        echo json_encode($response);
        break;

    case 'verification_plaque':
        // Récupération du numéro de plaque
        $numeroPlaque = isset($_GET['numeroPlaque']) ? $_GET['numeroPlaque'] : '';

        // Requête SQL préparée pour vérifier si le numéro de plaque existe dans la table Plaque
        $query = "SELECT * FROM Plaque WHERE numeroPlaque = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$numeroPlaque]);

        // Vérification du résultat
        if ($stmt->rowCount() > 0) {
            // Numéro de plaque trouvé dans la base de données
            $response = array(
                'numeroPlaque' => $numeroPlaque,
                'verification' => 'TRUE'
            );
            echo json_encode($response);
        } else {
            // Numéro de plaque non trouvé dans la base de données
            $response = array(
                'numeroPlaque' => $numeroPlaque,
                'verification' => 'FALSE'
            );
            echo json_encode($response);
        }
        break;

        case 'liste_admin':
            try {
                // Requête SQL pour sélectionner tous les administrateurs
                $query = "SELECT * FROM Administrateur";
                $stmt = $pdo->query($query);
        
                // Vérification du résultat
                if ($stmt->rowCount() > 0) {
                    // Création d'un tableau pour stocker tous les administrateurs
                    $administrateurs = array();
        
                    // Parcourir chaque ligne de résultat
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // Ajouter chaque administrateur à notre tableau
                        $administrateurs[] = array(
                            'idAdministrateur' => $row['idAdministrateur'],
                            'utilisateur' => $row['utilisateur'],
                            'nom' => $row['nom'],
                            'prenom' => $row['prenom'],
                            'mail' => $row['mail']
                            // Ajouter d'autres colonnes si nécessaire
                        );
                    }
        
                    // Renvoyer la liste des administrateurs sous forme de réponse JSON
                    echo json_encode($administrateurs);
                } else {
                    // Aucun administrateur trouvé
                    echo json_encode(array('message' => 'Aucun administrateur trouvé'));
                }
            } catch (PDOException $e) {
                // En cas d'erreur PDO lors de l'exécution de la requête
                echo json_encode(array('error' => 'Erreur PDO : ' . $e->getMessage()));
            }
            break;

            case 'supprimer_admin':

                // Récupérer le contenu JSON de la requête
                $json_data = file_get_contents('php://input');
                    
                // Décoder le JSON en un tableau associatif
                $data = json_decode($json_data, true);

                // Récupération du paramètre utilisateur envoyé en POST
                $utilisateur = isset($data['utilisateur']) ? $data['utilisateur'] : '';
            
                // Vérification que le paramètre utilisateur n'est pas vide
                if (!empty($utilisateur)) {
                    try {
                        // Requête SQL pour supprimer l'administrateur avec cet utilisateur
                        $query = "DELETE FROM Administrateur WHERE utilisateur = ?";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute([$utilisateur]);
            
                        // Vérification du résultat de la suppression
                        if ($stmt->rowCount() > 0) {
                            echo json_encode(array('message' => 'Administrateur supprimé avec succès'));
                        } else {
                            echo json_encode(array('message' => 'Aucun administrateur correspondant à cet utilisateur'));
                        }
                    } catch (PDOException $e) {
                        // En cas d'erreur PDO lors de la suppression
                        echo json_encode(array('error' => 'Erreur PDO : ' . $e->getMessage()));
                    }
                } else {
                    // Si le paramètre utilisateur est vide
                    echo json_encode(array('message' => 'Paramètre utilisateur manquant'));
                }
                break;

                case 'liste_utilisateur':
                    // Traitement de la récupération de la liste des utilisateurs
                    try {
                        // Requête SQL pour sélectionner tous les utilisateurs
                        $query = "SELECT * FROM Utilisateur";
                        $stmt = $pdo->query($query);
                
                        // Vérification du résultat
                        if ($stmt->rowCount() > 0) {
                            // Création d'un tableau pour stocker tous les utilisateurs
                            $utilisateurs = array();
                
                            // Parcourir chaque ligne de résultat
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                // Ajouter chaque utilisateur à notre tableau
                                $utilisateurs[] = array(
                                    'idUtilisateur' => $row['idUtilisateur'],
                                    'utilisateur' => $row['utilisateur'],
                                    'nom' => $row['nom'],
                                    'prenom' => $row['prenom'],
                                    'mail' => $row['mail'],
                                    'status' => $row['status']
                                    // Ajouter d'autres colonnes si nécessaire
                                );
                            }
                            // Renvoyer la liste des utilisateurs sous forme de réponse JSON
                            echo json_encode($utilisateurs);
                        } else {
                            // Aucun utilisateur trouvé
                            echo json_encode(array('message' => 'Aucun utilisateur trouvé'));
                        }
                    } catch (PDOException $e) {
                        // En cas d'erreur PDO lors de l'exécution de la requête
                        echo json_encode(array('error' => 'Erreur PDO : ' . $e->getMessage()));
                    }
                    break;



                    case 'role_utilisateur':

                // Récupérer le contenu JSON de la requête
                $json_data = file_get_contents('php://input');
                    
                // Décoder le JSON en un tableau associatif
                $data = json_decode($json_data, true);

                        // Récupérer les paramètres envoyés en POST
                        $utilisateur = isset($data['utilisateur']) ? $data['utilisateur'] : '';
                        $status = isset($data['status']) ? $data['status'] : '';
                    
                        // Vérifier si les paramètres requis sont présents et si le statut est valide
                        if (!empty($utilisateur) && !empty($status) && ($status == 'totale' || $status == 'reduit')) {
                            try {
                                // Requête SQL pour mettre à jour le statut de l'utilisateur
                                $query = "UPDATE Utilisateur SET status = :status WHERE utilisateur = :utilisateur";
                                $stmt = $pdo->prepare($query);
                                $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                                $stmt->bindParam(':utilisateur', $utilisateur, PDO::PARAM_STR);
                                $stmt->execute();
                    
                                // Vérification du résultat de la mise à jour
                                if ($stmt->rowCount() > 0) {
                                    echo json_encode(array('message' => 'Statut de l\'utilisateur mis à jour avec succès'));
                                } else {
                                    echo json_encode(array('message' => 'Aucun utilisateur correspondant trouvé'));
                                }
                            } catch (PDOException $e) {
                                // En cas d'erreur PDO lors de la mise à jour
                                echo json_encode(array('error' => 'Erreur PDO : ' . $e->getMessage()));
                            }
                        } else {
                            // Si l'un des paramètres est vide ou si le statut n'est pas valide
                            echo json_encode(array('message' => 'Paramètres manquants ou statut invalide'));
                        }
                        break;
                        case 'export_plaque_blacklist':
                            try {
                                // Requête SQL pour sélectionner les plaques blacklistées
                                $query = "SELECT * FROM Plaque WHERE status_blacklist = 'oui'";
                                $stmt = $pdo->query($query);
                        
                                // Vérification du résultat
                                if ($stmt->rowCount() > 0) {
                                    // Création d'un tableau pour stocker les données
                                    $plaqueData = array();
                        
                                    // Boucle à travers les résultats pour stocker les plaques blacklistées
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $plaqueData[] = $row;
                                    }
                        
                                    // Nom du fichier CSV
                                    $filename = 'plaque_blacklist.csv';
                        
                                    // En-tête pour forcer le téléchargement du fichier CSV
                                    header('Content-Type: text/csv');
                                    header('Content-Disposition: attachment; filename="' . $filename . '"');
                        
                                    // Ouvrir le fichier CSV en écriture
                                    $file = fopen('php://output', 'w');
                        
                                    // Écrire l'en-tête du fichier CSV
                                    fputcsv($file, array_keys($plaqueData[0]));
                        
                                    // Écrire les données des plaques blacklistées dans le fichier CSV
                                    foreach ($plaqueData as $plaque) {
                                        fputcsv($file, $plaque);
                                    }
                        
                                    // Fermer le fichier CSV
                                    fclose($file);
                        
                                    // Arrêter l'exécution du script
                                    exit();
                                } else {
                                    // Aucune plaque blacklistée trouvée
                                    echo json_encode(array('message' => 'Aucune plaque blacklistée trouvée'));
                                }
                            } catch (PDOException $e) {
                                // En cas d'erreur PDO lors de l'exécution de la requête
                                echo json_encode(array('error' => 'Erreur PDO : ' . $e->getMessage()));
                            }
                            break;
                        case 'export_plaque': 
                            
}

// Fermeture de la connexion PDO.
$pdo = null;

?>
