<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    // Inclusion du fichier de connexion à la base de données
    require 'connexion.php';
    try {
        // Vérifie si le bouton "savee" a été cliqué (indiquant que le formulaire a été soumis)
        if (isset($_POST['savee'])){
        // Vérifie si le bouton "savee" a été cliqué (indiquant que le formulaire a été soumis)
    $tit = $_POST['tit']; //récupére le titre de la série
    $u = $_POST['url']; //récupére l'URL
    $d = $_POST['nbs'] ; //récupére le nombre de saisons (nbs) de la série
    $i = $_POST['imgs'] ; // Le lien ou chemin de l'image associée à la série
    $c = $_POST['categorieS']; // La catégorie de la série
    
    // Requête SQL pour mettre à jour les informations de la série dans la base de données
    // La mise à jour se fait en fonction du titre (tit)
    $que = $connexion->query("UPDATE serie set url = '$u' , nbs = '$d' , imgs = '$i' , categorieS = '$c' where tit = '$tit'");
    
    // Redirige l'utilisateur vers une autre page après la mise à jour réussie
    header("Location: corractadmin.php");
        }
    }catch(Exception $e){
        // Gestion des erreurs
        // Affiche un message d'erreur si une exception est levée
        echo "error".$e->getMessage();
    }

    ?>
</body>
</html>