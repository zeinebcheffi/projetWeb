<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
         body {
    background-color: #5d8aa8; /* Couleur de fond (gris clair) */
}


.card {
    width: 18rem;
    height: 400px;
    position: relative;
    overflow: hidden;
    cursor: pointer;
    margin-top: 20px; /* Ajouter un espace au-dessus des cartes */
}

.card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card-body {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8); /* Transparent black background */
    color: white;
    font-size: 16px;
    opacity: 0; /* Hidden by default */
    visibility: hidden; /* Hidden by default */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    transition: opacity 0.3s ease, visibility 0.3s ease; /* Smooth transition */
    z-index: 2;
}

/* Show the card body when hovering over the card */
.card:hover .card-body {
    opacity: 1; /* Make visible */
    visibility: visible; /* Make visible */
}

.card-body h5.card-title {
    color: grey;
}

.card-body a {
    color: gray;
}

.card-body .info-button {
    color: black;
    background-color: white;
    border: 1px solid red;
    padding: 8px 16px;
    cursor: pointer;
}

.card-body .info-button:hover {
    background-color: red;
    color: white;
}
.navbar .form-inline .btn,
.navbar .form-inline .custom-select {
    margin-left: 10px; /* Ajustez cette valeur selon vos besoins */
}


</style>
</head>
<body>
<?php
// Démarrer la session pour utiliser les variables de session
session_start();
?>
    
    <center>
        <!-- Début du formulaire de navigation -->
        <form action="" method="post">

        <!-- Barre de navigation -->
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #faebd7;">
        <!-- Afficher le compte de l'utilisateur connecté -->
        <a class="navbar-brand" href="#"><?php echo "Compte ".$_SESSION['username'];?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <form class="form-inline my-2 my-lg-0 ml-auto" method="post">
        <!-- Champ de recherche -->    
        <input class="form-control mr-sm-2" type="search" name="chercher" id="chercher" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0 ml-2" type="submit">Search</button>
            <div class="btn-group ml-2" role="group">
                <!-- Liens pour ajouter des séries ou films -->
                <a href="formajoutserie.php" class='btn btn-danger'>ajouter serie</a>
                <a href="formajoutfilm.php" class='btn btn-danger'>ajouter film</a>
            </div>
            <!-- Sélection du type (Tous, Series, Movies) -->
            <select class="custom-select mr-sm-2 ml-2" name="sel">
                <option>Tous</option>
                <option>Series</option>
                <option>Movies</option>
            </select>
            <!-- Sélection de la catégorie (Genre) -->
            <select class="custom-select mr-sm-2 ml-2" name="gen">
                <option>Tous</option>
                <option>comedie</option>
                <option>Action</option>
                <option>Horror</option>
                <option>thriller</option>
                <option>romance</option>
            </select>
            <!-- Bouton de déconnexion -->
            <a href="page1.php" class="btn btn-outline-danger ml-2 my-2 my-sm-0" id="sc">Se déconnecter</a>
        </form>
    </div>
</nav>

        <!-- Conteneur pour afficher les séries et films -->
        <div class="container">
            <?php
            require 'connexion.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                try {
                    // Récupérer les valeurs des champs du formulaire
                    $chercher = $_POST['chercher'];
                    $sel = $_POST['sel'];
                    $gen = $_POST['gen'];

                    // Construire les requêtes SQL en fonction des critères
                    if ($gen != 'Tous') {
                        // Filtrer par catégorie spécifique
                        $serieRows = $connexion->query("SELECT *, 'serie' as type FROM serie WHERE UPPER(tit) LIKE UPPER('$chercher%') AND categorieS = '$gen'")->fetchAll(PDO::FETCH_ASSOC);
                        $filmRows = $connexion->query("SELECT *, 'film' as type FROM film WHERE UPPER(tit) LIKE UPPER('$chercher%') AND categorieS = '$gen'")->fetchAll(PDO::FETCH_ASSOC);
                    } else if ($gen == 'Tous') {
                        // Récupérer toutes les catégories
                        $serieRows = $connexion->query("SELECT *, 'serie' as type FROM serie WHERE UPPER(tit) LIKE UPPER('$chercher%')")->fetchAll(PDO::FETCH_ASSOC);
                        $filmRows = $connexion->query("SELECT *, 'film' as type FROM film WHERE UPPER(tit) LIKE UPPER('$chercher%') ")->fetchAll(PDO::FETCH_ASSOC);
                    }

                    // Filtrer les résultats selon le type sélectionné
                    if ($sel == 'Series') {
                        $combinedRows = $serieRows;
                    } else if ($sel == 'Movies') {
                        $combinedRows = $filmRows;
                    } else {
                        $combinedRows = array_merge($serieRows, $filmRows);
                    }

                    // Afficher les séries et films sous forme de cartes
                    echo '<div class="row" style="overflow-x: auto; white-space: nowrap;">';

                    foreach ($combinedRows as $row) {
                        echo '<div class="col-md-3">';
                        echo '<div class="card" style="width: 18rem;">';
                        echo '<img class="card-img-top" src="' . $row['imgs'] . '" alt="Card image cap" name="url">';
                        echo '<div class="card-body">';
                        if ($row['type'] == 'serie') {
                            echo '<h5 class="card-title">Nombre de saisons: ' . $row['nbs'] . '</h5>';
                            echo '<h5 class="card-title">Title: ' . $row['tit'] . '</h5>';
                            echo '<h5 class="card-title">Categorie : ' . $row['categorieS'] . '</h5><br>';
                            echo '<a href="' . $row['url'] . '" class="info-button">Plus d\'information</a> <br><br><br><br>';
                            echo "<a href='enregistreserie.php?mod=" . $row['tit'] . "' class='btn btn-success' calss='a'>Modifier</a>";  
                            echo "<a href='suup.php?sup=" . $row['tit'] . "' class='btn btn-danger' class='a'>Supprimer</a>";                  
                    
    
                        } elseif ($row['type'] == 'film') {
                            
                            echo '<h5 class="card-title">Durée : ' . $row['duree'] . '</h5>';
                            echo '<h5 class="card-title">Title: ' . $row['tit'] . '</h5>';
                            echo '<h5 class="card-title">Categorie : ' . $row['categorieS'] . '</h5><br>';
                            echo '<a href="' . $row['url'] . '" class="info-button">Plus d\'information</a><br><br> <br><br>';
                            echo "<a href='enregistrefilm.php?mod=" . $row['tit'] . "' class='btn btn-success'>Modifier</a>";    
                            echo "<a href='suup.php?sup=" . $row['tit'] . "' class='btn btn-danger'>Supprimer</a>";                  
    
                        }
                        
                         
    
                         
                           echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</div>';
                } catch (Exception $e) {
                    // Afficher une erreur en cas d'exception
                    echo 'Erreur: ' . $e->getMessage();
                }
            } else {
                // Afficher toutes les séries et films par défaut
                $serieRows = $connexion->query("SELECT *, 'serie' as type FROM serie")->fetchAll(PDO::FETCH_ASSOC);
                $filmRows = $connexion->query("SELECT *, 'film' as type FROM film")->fetchAll(PDO::FETCH_ASSOC);

                $combinedRows = array_merge($serieRows, $filmRows);

                echo '<div class="row">';

                foreach ($combinedRows as $row) {
                    echo '<div class="col-md-3">';
                    echo '<div class="card" style="width: 18rem;">';
                    echo '<img class="card-img-top" src="' . $row['imgs'] . '" alt="Card image cap" name="url">';
                    echo '<div class="card-body">';
                    if ($row['type'] == 'serie') {
                        echo '<h5 class="card-title">Nombre de saisons: ' . $row['nbs'] . '</h5>';
                        echo '<h5 class="card-title">Title: ' . $row['tit'] . '</h5>';
                        echo '<h5 class="card-title">Categorie : ' . $row['categorieS'] . '</h5>';
                        echo '<a href="' . $row['url'] . '" class="info-button">Plus d\'information</a><br><br> <br><br>';
                        echo "<a href='enregistreserie.php?mod=" . $row['tit'] . "' class='btn btn-success'>Modifier</a>";  
                        echo "<a href='suup.php?sup=" . $row['tit'] . "' class='btn btn-danger'>Supprimer</a>";                  
                

                    } elseif ($row['type'] == 'film') {
                        
                        echo '<h5 class="card-title">Durée : ' . $row['duree'] . '</h5>';
                        echo '<h5 class="card-title">Title: ' . $row['tit'] . '</h5>';
                        echo '<h5 class="card-title">Categorie : ' . $row['categorieS'] . '</h5>';
                        echo '<a href="' . $row['url'] . '" class="info-button">Plus d\'information</a><br><br> <br><br>';
                        echo "<a href='enregistrefilm.php?mod=" . $row['tit'] . "' class='btn btn-success'>Modifier</a>";    
                        echo "<a href='suup.php?sup=" . $row['tit'] . "' class='btn btn-danger'>Supprimer</a>";                  

                    }
                    
                   
                       echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }

                echo '</div>';
            }
            ?>
            </body>
            </html>