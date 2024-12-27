<?php
// Inclusion du fichier de connexion à la base de données
require 'connexion.php';

try {
    // Vérifie si le formulaire a été soumis en vérifiant l'existence du champ 'ajoutserie'
    if (isset($_POST['ajoutserie'])) {
        // Récupération des données envoyées via le formulaire
        $titre = $_POST['tit'];
        $url = $_POST['url'];
        $nbs = $_POST['nbs'];
        $image = $_POST['imgs'];
        $categorie = $_POST['categorieS'];

        // Préparation de la requête SQL pour insérer une nouvelle série dans la table `serie`
        $qu = $connexion->prepare("INSERT INTO serie (tit, url, nbs, imgs, categorieS) VALUES (?, ?, ?, ?,?)");
        
        // Exécution de la requête avec les valeurs fournies par le formulaire
        $success = $qu->execute([$titre, $url ,$nbs, $image, $categorie]);
      
            // Si l'insertion réussit (pas d'erreur SQL), redirige vers la page `corractadmin.php`
            header('location:corractadmin.php');
        }
    } catch (Exception $e) {
        // Gestion des exceptions : affiche un message d'erreur en cas de problème
        echo "Error: " . $e->getMessage();
    }
       
?>

