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
        // Vérifie si le bouton "save" a été cliqué (formulaire soumis)
        if (isset($_POST['save'])){
        // Récupère les données du formulaire envoyées par la méthode POST
    $tit = $_POST['tit']; //récupére le titre du film   
    $u = $_POST['url']; //récupére l'URL du film
    $d = $_POST['duree'] ; //récupére la duréé du film
    $i = $_POST['imgs'] ; //récupére une image 
    $c = $_POST['categorieS']; //récupére la catégories du film
    
    // Exécute une requête SQL pour mettre à jour les informations du film dans la base de données
    // La mise à jour se fait en fonction du titre (tit)
    $que = $connexion->query("UPDATE film set url = '$u' , duree = '$d' , imgs = '$i' , categorieS = '$c' where tit = '$tit'");
    // Redirige l'utilisateur vers la page de l'admin 
    header("Location: corractadmin.php");
        }
    }catch(Exception $e){
        // Affiche un message d'erreur si une exception est levée
        echo "error".$e->getMessage();
    }

    ?>
</body>
</html>