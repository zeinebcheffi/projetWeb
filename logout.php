<?php 

// Démarre une nouvelle session
session_start   ();

// Détruit toutes les données associées à la session active
if(session_destroy())

// Si la session est détruite avec succès, redirige l'utilisateur vers la page "page1.php" 
header('Location: page1.php');

?> 