  <?php
require 'connexion.php'; // Inclut le fichier contenant la connexion à la base de données

// Vérifie si le paramètre 'sup' a été passé dans l'URL
if (isset($_GET['sup'])) {
    $titreMedia = $_GET['sup']; // Récupère le titre du média à supprimer depuis le paramètre 'sup'

    try {
        // Configure le mode d'erreur PDO pour afficher les exceptions
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour supprimer une série avec un titre donné
        $reqSerie = "DELETE FROM serie WHERE tit = :titre";
        // Requête SQL pour supprimer une série avec un titre donné
        $reqFilm = "DELETE FROM film WHERE tit = :titre";

        // Préparer et exécuter la requête pour supprimer une série
        $pdostateSerie = $connexion->prepare($reqSerie);
        $pdostateSerie->bindParam(':titre', $titreMedia, PDO::PARAM_STR); // Associe la variable $titreMedia au paramètre ':titre'
        $pdostateSerie->execute(); // Exécute la requête préparée

        // Préparez et exécutez la requête pour supprimer le film
        $pdostateFilm = $connexion->prepare($reqFilm);
        $pdostateFilm->bindParam(':titre', $titreMedia, PDO::PARAM_STR);
        $pdostateFilm->execute();

        // Redirige l'utilisateur vers la page corractadmin.php après la suppression
        header("Location: corractadmin.php");
        exit();
    } catch (PDOException $e) {
        // Affiche un message d'erreur en cas d'exception
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // Message affiché si le paramètre 'sup' n'est pas spécifié dans l'URL
    echo "Paramètre 'sup' non spécifié.";
}
?>
