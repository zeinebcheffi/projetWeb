<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <!-- Formulaire de connexion -->
    <form method="post" action=""> <!-- Méthode POST utilisée pour envoyer les données au serveur -->
<div class='form2'></div>
                <div class='a'>
                    <div class='row justify-content-center'>
                        <div class='col-md-6'>
                        <div class='form-group'>
                            <!-- Champ pour le nom d'utilisateur -->
                                <label >username:</label>
                                <input type='text' class='form-control' placeholder='Enter your username' name="use">
                            </br>
                                <!-- Champ pour le numéro -->
                                <label>number:</label>
                                <input type='number' class='form-control' placeholder='Enter your number' name="num">
                            </br>
                                <!-- Champ pour l'adresse email -->
                                <label for='email'>Email:</label>
                                <input type='email' class='form-control' placeholder='Enter your email' required name="email">
                            </br>
                                <!-- Champ pour le mot de passe -->
                                <label for='password'>Password:</label>
                                <input type='password' class='form-control' placeholder='Enter your password' name="pass"><br>
                                <!-- Bouton de soumission -->
                                <input type="submit" class='btn btn-danger' name ='conn' value='se connecter'>
                            
                        </div>
                    </div>
                </div>
                <
            </div>";
    <!-- Conteneur pour inclure le script PHP -->
    <div class="container">
        <?php
        // Démarrer une session pour gérer les données utilisateur
        session_start();
       require 'connexion.php'; // Inclure le fichier contenant les informations de connexion à la base de données
       // Vérifier si le bouton "se connecter" a été cliqué     
       if (isset($_POST['conn'])) {
        // Récupérer les données saisies dans les champs du formulaire
                $a  = $_POST['use']; // récupére le Nom d'utilisateur
                $b = $_POST['num']; // récupére le Numéro
                $n = $_POST['email']; // récupére l'Email
                $p = $_POST['pass']; // récupére le Mot de passe
try {

    // Insérer les données saisies dans la table "users"
    $que = $connexion->query("INSERT INTO users (username, number, Email, password) VALUES ('$a', $b, '$n', '$p')");

                // Si l'insertion réussit, sauvegarder le nom d'utilisateur dans la session et rediriger
                if ($que){
                    $_SESSION['username'] = $a; // Sauvegarder l'utilisateur dans la session
                    header('Location: interface1.php'); // Redirection vers une autre page

                }
}catch (Exception $e) {
    // En cas d'erreur, afficher une alerte JavaScript
    echo "<script>alert('Autre username');</script>";
   
}

            }
            
        ?>
    </div>

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

.a {
    width: 600px;
    height: 400px;
    background: transparent;
    backdrop-filter: blur(20px);
    border-radius: 20px;
    position: absolute;
    top: 50%;
    left: 70%;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: column;
    align-items: center;
}
.form-control {
            color: white;
            background: transparent; /* Make the input background transparent */
            border: none;
            border-bottom: 2px solid white; /* Add a white border-bottom */
            outline: none;
        }
.form-group {
    color: white;
    text-align: center;
    font-weight: bold;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    margin-bottom: 20px;
}

.form-group .input {
    color: white;
            font-weight: bold;
            position: relative;
            top: 100%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
}



/* Ajout d'un style pour le focus */


</style>
</body>
</html>