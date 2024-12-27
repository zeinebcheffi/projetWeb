<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<form method="post" action="">
    <!-- Formulaire de connexion -->
                <div class ='form2'></div>
                <div class='a'>
                
                    <div class='row justify-content-center'>
                        <div class='col-md-6'>
                           
                         
                            <div class='form-group'>
                                <label>username:</label>
                                <input type='text' class='form-control' name="username" placeholder='Enter your email' required>
                            </div>
                            <div class='form-group'>
                                <label >Password:</label>
                                <input type='password' class='form-control' name="password"placeholder='Enter your password'>
                            </div>
                            <!-- Bouton de soumission -->
                            <div class='bb'>
                            <button type='submit' class='btn btn-danger' name="conn" >se connecter</button>
                        </div>
                    </div>

                </div>
                </div>
 
       
                <?php
                // Initialisation de la session PHP

session_start();

// Inclusion du fichier de connexion à la base de données
require 'connexion.php';

// Vérifie si le bouton "se connecter" a été cliqué
if (isset($_POST['conn'])) {
    // Récupération des données du formulaire
    $a = $_POST['username'];
    $b = $_POST['password'];

    try {
        // Requêtes pour vérifier l'existence de l'utilisateur et du mot de passe
        $user = $connexion->query("SELECT username FROM users WHERE username = '$a'");
        $pass = $connexion->query("SELECT password FROM users WHERE password = '$b'");
        $role = $connexion->query("SELECT role FROM users WHERE username = '$a' AND password = '$b'");

        // Vérifie si les champs sont vides
        if (empty($a)|| empty($b)){
            die("Please enter cordonnés.");
        }

        // Vérifie si l'utilisateur et le mot de passe sont corrects
        if( $role->rowCount() > 0) {
            // Récupère le rôle de l'utilisateur
            $row = $role->fetch();
            $userRole = $row['role'];

            // Redirection en fonction du rôle
            if ($userRole == 'O') {
                $_SESSION['username'] = $a;
                header('Location: corractadmin.php');// Page pour l'admin
                
            } else {
                $_SESSION['username'] = $a;
                header('Location: interface1.php');// Page pour les utilisateurs
                

            }
        } else {
            // Affiche une alerte si les identifiants sont incorrects
            echo "<script>alert('introuvable');</script>";
        }
    } catch (Exception $e) {
        // Gestion des erreurs
        echo 'Erreur: ' . $e->getMessage();
    }
}
?>


            
      
    </div>

    <!-- Lien vers les scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-eU7GxUeZhUhzuoJsZB8LuC4l3/AxrUaeTsckAcUW9LlCjUNY6c6m9heS9fn1I4N6" crossorigin="anonymous"></script>
    <style>
    body {
        margin: 0;
        background-color: black;
        overflow: hidden;
    }

    .form2 {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.4;
        background-image: url('img4.png');
        background-size: cover;
        background-position: center;
        z-index: -1;
    }

    .form-group {
        color: white;
        font-weight: bold;
        position: relative;
        top: 100%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .form-control {
        color: white;
        background: transparent; 
        border: none;
        border-bottom: 2px solid white; 
        outline: none;
    }

    .a {
        width: 600px;  /* Augmenter la largeur */
        height: 500px; /* Augmenter la hauteur */
        background: transparent;
        border: 3px solid rgba(255, 255, 255, -2);
        box-shadow: 0 0 10px rgba(0, 0, 0, -2);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        position: absolute;
        top: 50%;
        right: 5%; /* Toujours à droite */
        transform: translate(0, -50%); /* Centrer verticalement */
        padding: 20px;  /* Ajouter du padding pour plus de confort à l'intérieur */
    }

    .bb {
        position: absolute;
        top: 70%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>



</body>
</html>