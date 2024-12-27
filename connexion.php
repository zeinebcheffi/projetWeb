<?php 
try {
    // Création d'une connexion à la base de données en utilisant PDO
    $connexion=new PDO("mysql:host=localhost;dbname=miniprojetphp",'root','');

    // Configuration des attributs de PDO pour lever des exceptions en cas d'erreurs
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
catch (PDOException $e) {
    // Gestion des erreurs de connexion : si une exception est levée, affiche un message d'erreur
    echo "Error: " . $e->getMessage();}    
?>