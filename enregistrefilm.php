<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Films</title>
    <style>
    body {
        background-color: #560f0f;
        color: #E0E0E0;
        font-family: 'Arial', sans-serif;
        padding: 20px;
    }

    h1 {
        color: #FF5722;
        text-align: center;
        font-size: 2.5em;
        margin-bottom: 20px;
    }
    img {
        display: block;
        margin: 0 auto; /* Centre l'image horizontalement */
        margin-top: 20px; /* Ajoute un espace en haut */
        width: 150px; /* Ajustez la taille selon votre préférence */
        height: auto;
        border-radius: 10px; /* Ajoute des coins arrondis si souhaité */
    }

    table {
        width: 60%;
        margin: 20px auto;
        border-collapse: collapse;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    }

    th, td {
        border: 1px solid #333;
        padding: 12px 15px;
        text-align: left;
        background-color: #1E1E1E;
    }

    th {
        background-color: #FF5722;
        color: #FFF;
    }

    input[type="text"] {
        border: 1px solid #666;
        border-radius: 5px;
        padding: 10px;
        width: calc(100% - 20px);
        margin-bottom: 15px;
        background-color: #333;
        color: #FFF;
        font-size: 14px;
    }
    h2 {
        text-align: center; /* Centre horizontalement */
        color: white; /* Couleur personnalisée, optionnelle */
        margin-top: 20px; /* Espacement au-dessus, optionnel */
        font-size: 2em; /* Ajustez la taille selon vos besoins */
    }

    input[type="submit"] {
        background-color: #FF5722;
        color: #FFF;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #E64A19;
    }

    form {
        margin: 0 auto;
        width: 50%;
        padding: 20px;
        background-color: #1E1E1E;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    }
    .button-container {
        text-align: center; /* Centre le contenu horizontalement */
        margin-top: 20px; /* Ajoute un espace au-dessus, si nécessaire */
    }

    input[type="submit"] {
        background-color: #FF5722;
        color: #FFF;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #E64A19;
    }
</style>

</head>
<body>
   

    <h1>Modification Films</h1>
    
    <?php 
    // Inclusion du fichier pour établir la connexion à la base de données
    require 'connexion.php';

    // Récupération du paramètre 'mod' envoyé via l'URL pour identifier le film à modifier
    $n = $_GET['mod'] ;
    try {
        // Exécution d'une requête pour récupérer les données du film correspondant au titre ($n)
        $query = $connexion->query("SELECT * FROM film WHERE tit = '$n'");
        
        // Parcours des résultats de la requête pour assigner les valeurs des colonnes à des variables
        foreach ($query as $ligne){
            $tit = $ligne['tit'];
            $url = $ligne['url'];
            $d = $ligne['duree']; 
            $i = $ligne['imgs']; 
            $c = $ligne['categorieS'];
        }
    } catch(Exception $e){
        // Affiche un message d'erreur en cas de problème avec la requête SQL
        echo "error" . $e->getMessage();
    }
    ?>

    <div>
        <h2>Film: <?php echo $tit; ?></h2>
        
        <div>
            <!-- Affiche l'image du film -->
            <img src="<?php echo $i; ?>" alt="Film Image" style="width: 300px; height: 400px; object-fit: cover;">
        </div>

        <!-- Formulaire permettant de modifier les informations du film -->
        <form action='modifierfilm.php' method='post'>
            <table>
                <tr>
                    <th>Titre </th>
                    <td><input type='text' name='tit' value ="<?php echo $tit; ?>"></td>
                </tr>
                <tr>
                    <th>URL</th>
                    <td><input type='text' name='url' value ="<?php echo $url; ?>"></td>
                </tr>
                <tr>
                    <th>Durée </th>
                    <td><input type='text' name='duree' value ="<?php echo $d; ?>"></td>
                </tr>
                <tr>
                    <th>Image </th>
                    <td><input type='text' name='imgs' value ="<?php echo $i; ?>"></td>
                </tr>
                <tr>
                    <th>Catégorie </th>
                    <td><input type='text' name='categorieS' value ="<?php echo $c; ?>"></td>
                </tr>
            </table>
            <!-- Bouton pour soumettre le formulaire -->
            <div class="button-container">
    <input type="submit" value="Appliquer" name="save">
</div>        
</form>
    </div>
</body>
</html>
