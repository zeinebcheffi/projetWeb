<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Browser</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
    background-color: #5d8aa8; /* Couleur de fond (gris clair) */
}

       .card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
     margin-top: 20px;
}

.card {
    width: 18rem;
    height: 400px;
    position: relative;
    overflow: hidden;
    margin-bottom: 20px;
   
    border-radius: 10px;
    border: none;
    color: #ffffff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
}

.card img {
    width: 100%;
    height: 400px;
   
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.4);
}

.card-body {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 10px;
    background: rgba(0, 0, 0, 0.2);
    color: white;
    text-align: center;
    transition: background 0.2s ease, padding 0.2s ease;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}

.card:hover .card-body {
    background: rgba(0, 0, 0, 0.6);
    padding: 15px;
}

.card-body h3 {
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.card-body p {
    font-size: 0.9rem;
    margin: 2px 0;
    opacity: 0.9;
}

.info-button {
    display: inline-block;
    color: black;
    background-color: white;
    border: 1px solid red;
    padding: 5px 60px;
    cursor: pointer;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.5rem;
    font-weight: bold;
    transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
}

.info-button:hover {
    background-color: white;
    color: red;
    transform: scale(1.1);
}

navbar .form-inline .btn, 
    .navbar .form-inline .custom-select {
        margin-left: 10px; /* Ajustez la valeur selon vos besoins */
    }

    </style>
</head>
<body>
    <?php 
    // Démarre la session pour pouvoir accéder aux variables de session
    session_start();
    ?>

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #faebd7;">

        <!-- Affiche le nom de l'utilisateur connecté -->
        <a class="navbar-brand" href="#">Compte <?php echo $_SESSION['username']; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu de navigation avec formulaire de recherche et filtres -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="form-inline my-2 my-lg-0 ml-auto" method="post">
                <input class="form-control mr-sm-2" type="search" name="chercher" id="chercher" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                <!-- Filtre pour sélectionner les séries ou films -->
                <select class="custom-select mr-sm-2" name="sel">
                    <option value="Tous">Tous</option>
                    <option value="Series">Series</option>
                    <option value="Movies">Movies</option>
                </select>
                <!-- Filtre pour sélectionner la catégorie -->
                <select class="custom-select mr-sm-2" name="gen">
                    <option value="Tous">Tous</option>
                    <option value="comedie">Comédie</option>
                    <option value="Action">Action</option>
                    <option value="Horror">Horror</option>
                    <option value="thriller">Thriller</option>
                    <option value="romance">Romance</option>
                </select>
                <!-- Lien pour se déconnecter -->
                <a href="logout.php" class="btn btn-outline-danger my-2 my-sm-0">Déconnexion</a>
            </form>
        </div>
    </nav>

    <!-- Conteneur pour afficher les cartes des films et séries -->
    <div class="container">
    <div class="card-container">
        <?php
        // Inclusion du fichier de connexion à la base de données
        require 'connexion.php';

        // Vérifie si le formulaire a été soumis avec la méthode POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                // Récupère les valeurs des champs du formulaire
                $chercher = $_POST['chercher'];
                $sel = $_POST['sel'];
                $gen = $_POST['gen'];

                // Si un genre spécifique est sélectionné
                if ($gen != 'Tous') {
                    // Effectue une requête pour récupérer les séries et films selon le genre et le terme de recherche
                    $serieRows = $connexion->query("SELECT *, 'serie' as type FROM serie WHERE UPPER(tit) LIKE UPPER('$chercher%') AND categorieS = '$gen'")->fetchAll(PDO::FETCH_ASSOC);
                    $filmRows = $connexion->query("SELECT *, 'film' as type FROM film WHERE UPPER(tit) LIKE UPPER('$chercher%') AND categorieS = '$gen'")->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    // Effectue une requête pour récupérer toutes les séries et films correspondant à la recherche
                    $serieRows = $connexion->query("SELECT *, 'serie' as type FROM serie WHERE UPPER(tit) LIKE UPPER('$chercher%')")->fetchAll(PDO::FETCH_ASSOC);
                    $filmRows = $connexion->query("SELECT *, 'film' as type FROM film WHERE UPPER(tit) LIKE UPPER('$chercher%')")->fetchAll(PDO::FETCH_ASSOC);
                }

                // Filtre les résultats en fonction de la sélection (Séries, Films ou Tous)
                if ($sel == 'Series') {
                    $combinedRows = $serieRows;
                } elseif ($sel == 'Movies') {
                    $combinedRows = $filmRows;
                } else {
                    // Donne toute la séléction(séries et films)
                    $combinedRows = array_merge($serieRows, $filmRows);
                }

                // Affiche les résultats sous forme de cartes
                foreach ($combinedRows as $row) {
                    echo '<div class="card">';
                    echo '<img class="card-img-top" src="' . $row['imgs'] . '" alt="Card image cap">';
                    echo '<div class="card-body">';
                    if ($row['type'] == 'serie') {
                        echo '<h5 class="card-title">Nombre de saisons: ' . $row['nbs'] . '</h5>';
                    } elseif ($row['type'] == 'film') {
                        echo '<h5 class="card-title">Durée: ' . $row['duree'] . '</h5>';
                    }
                    echo '<h5 class="card-title">Title: ' . $row['tit'] . '</h5>';
                    echo '<h5 class="card-title">Categorie: ' . $row['categorieS'] . '</h5>';
                    echo '<a href="' . $row['url'] . '" class="info-button">Plus d\'information</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } catch (Exception $e) {
                // Si une erreur se produit lors de l'exécution de la requête
                echo 'Erreur: ' . $e->getMessage();
            }
        } else {
            // Si le formulaire n'a pas été soumis, affiche toutes les séries et films
            $serieRows = $connexion->query("SELECT *, 'serie' as type FROM serie")->fetchAll(PDO::FETCH_ASSOC);
            $filmRows = $connexion->query("SELECT *, 'film' as type FROM film")->fetchAll(PDO::FETCH_ASSOC);

            // affiche toute la séléction(séries et films)
            $combinedRows = array_merge($serieRows, $filmRows);

            // Affiche les résultats sous forme de cartes
            foreach ($combinedRows as $row) {
                echo '<div class="card">';
                echo '<img class="card-img-top" src="' . $row['imgs'] . '" alt="Card image cap">';
                echo '<div class="card-body">';
                if ($row['type'] == 'serie') {
                    echo '<h5 class="card-title">Nombre de saisons: ' . $row['nbs'] . '</h5>';
                } elseif ($row['type'] == 'film') {
                    echo '<h5 class="card-title">Durée: ' . $row['duree'] . '</h5>';
                }
                echo '<h5 class="card-title">Title: ' . $row['tit'] . '</h5>';
                echo '<h5 class="card-title">Categorie: ' . $row['categorieS'] . '</h5>';
                echo '<a href="' . $row['url'] . '" class="info-button">Plus d\'information</a>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>
    </div>

    <!-- Importation des fichiers JavaScript nécessaires pour le bon fonctionnement de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
