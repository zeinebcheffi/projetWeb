<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Série</title>
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
        border-radius: 10px; /* Coins arrondis */
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
        color: white;
        margin-top: 20px;
        font-size: 2em;
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
        margin-top: 20px; /* Ajoute un espace au-dessus */
    }

    input[type="file"] {
        color: red;
        display: block;
        margin: 10px auto; /* Centre horizontalement */
    }
</style>

</head>
<body>
    

    <h1>Modification Série</h1>
    
    <?php 
    // Inclusion du fichier pour établir une connexion à la base de données
    require 'connexion.php';

    // Récupération du paramètre 'mod' envoyé via l'URL pour identifier la série à modifier
    $n = $_GET['mod'] ;
    try {
        // Requête SQL pour récupérer les informations de la série correspondant au titre ($n)
        $query = $connexion->query("SELECT * FROM serie WHERE tit = '$n'");
        
        // Parcours des résultats et assignation des valeurs des colonnes à des variables
        foreach ($query as $ligne){
            $t = $ligne['tit'];
            $u = $ligne['url'];
            $d = $ligne['nbs']; 
            $i = $ligne['imgs']; 
            $c = $ligne['categorieS'];
        }
    } catch(Exception $e){
        // Affichage d'un message d'erreur si la requête SQL échoue
        echo "error" . $e->getMessage();
    }
    ?>

    <div>
        <h2>Serie: <?php echo $t; ?></h2>
        
        <div>
            <img src="<?php echo $i; ?>" alt="Film Image" style="width: 300px; height: 400px; object-fit: cover;">
        </div>

        <!-- Formulaire pour modifier les informations de la série -->
        <form action='modifierserie.php' method='post'>
        <table>
                <tr>
                    <th>Titre </th>
                    <td><input type='text' name='tit' value ="<?php echo $t ?>"></td>
                </tr>
                <tr>
                    <th>URL</th>
                    <td><input type='text' name='url' value ="<?php echo $u ?>"></td>
                </tr>
                <tr>
                    <th>NOBRE DE SAISON </th>
                    <td><input type='text' name='nbs' value ="<?php echo $d ?>"></td>
                </tr>
                <tr>
                    <th>Image </th>
                    <td><input type='text' name='imgs' value ="<?php echo $i ?>"></td>
                </tr>
                <tr>
                    <th>Catégorie </th>
                    <td><input type='text' name='categorieS' value ="<?php echo $c; ?>"></td>
                </tr>
               
            </table>
            <!-- Bouton pour soumettre le formulaire et appliquer les modifications -->
            <div class="button-container">
    <input type="submit" value="Appliquer" name="savee">
</div>   
            <!-- Champ pour télécharger une nouvelle image -->
            <input type='file' name='newImage'>
        </form>
    </div>
</body>
</html>
