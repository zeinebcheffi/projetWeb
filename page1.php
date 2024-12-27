<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutons avec Background Flou</title>
    <!-- Importation de la bibliothèque Bootstrap pour les styles et la mise en page -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            background-color: black;
            overflow: hidden;
            font-family: 'Roboto Slab', serif;
            color: #e0e0e0;
        }

        .faza {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.6;
            background-image: url('img2.jfif');
            background-size: cover;
            background-position: center;
            z-index: -1;
        }

        .content {
            text-align: center;
            color: white;
            font-size: 40px;
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .button-container {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .btn {
            margin: 5px;
            font-size: 16px; 
            border-radius: 8px;
        }
        .btn-danger {
            background-color: #ffa700; 
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c62828; 
        }

        .ph1 {
            text-align: center;
            margin-top: 20px;
        }
        .ph1 h1 {
            font-size: 70px; 
            color: #ffeb3b; 
        }

        .ph1 p {
            font-size: 30px; 
            color: 	#ffffff; 
        }
    </style>
</head>

<body>
    <form action="sign_up.php" method="POST"> <!-- Redirection vers le fichier sign_up.php lors de la soumission -->
        <div class="faza"></div> <!-- arrière-plan flou -->
        <div class="content">
            <div class="container">
                <div class="button-container">
                    <!-- Bouton pour rediriger vers la page de connexion -->
                    <button type="button" class="btn btn-danger" onclick="login()">Login </button>
                    <!-- Bouton pour soumettre le formulaire de création de compte -->
                    <button type="submit" class="btn btn-danger" name="read">Sign Up</button>
                </div>
                <div class="ph1">
                    <h1>BIENVENUE !</h1>
                    <p>TROUVEZ TOUS VOS FILMS ICI !!</p>
                </div>
            </div>
        </div>
    </form>
    <!-- Section JavaScript -->
    <script>
        // Fonction appelée lors du clic sur le bouton "Login"
        function login() {
            window.location.href = 'login.php'; // Redirection vers la page login.php
        }
    </script>


   
</body>

</html>