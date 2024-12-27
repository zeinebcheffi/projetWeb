<?php
// Inclusion du fichier de connexion à la base de données
require 'connexion.php';

try {
    // Vérifie si le formulaire a été soumis en vérifiant l'existence du champ 'ajoutfilm'
    if (isset($_POST['ajoutfilm'])) {
        // Récupération des données saisies dans le formulaire
        $titre = $_POST['tit'];
        $url = $_POST['url'];
        $duree = $_POST['duree'];
        $image = $_POST['imgs'];
        $categorie = $_POST['categorieS'];

        // Préparation de la requête SQL pour insérer un nouveau film dans la base de données
        $pdostat = $connexion->prepare("INSERT INTO film (tit, url, duree, imgs, categorieS) VALUES (?, ?, ?, ?, ?)");
        
        // Liaison des valeurs du formulaire avec les paramètres de la requête
        $pdostat->bindParam(1, $titre);
        $pdostat->bindParam(2, $url);
        $pdostat->bindParam(3, $duree);
        $pdostat->bindParam(4, $image);
        $pdostat->bindParam(5, $categorie);

        // Exécution de la requête
        if ($pdostat->execute()) {
            // Si l'exécution réussit, redirige l'utilisateur vers une autre page (corractadmin.php)
            header("Location: corractadmin.php");
            exit();// Arrête le script après la redirection
        } else {
            // Si l'exécution échoue, affiche un message d'erreur
            echo 'Error!';
        }
    }
} catch (Exception $e) {
    // Gestion des exceptions : affiche un message d'erreur en cas de problème
    echo 'Erreur : ' . $e->getMessage();
}
?>
