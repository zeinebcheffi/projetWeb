# projetWeb
Gestion de Films
Description:
Ce projet est une application web de gestion de films avec un système de rôles. Les administrateurs peuvent ajouter, modifier et supprimer des films, tandis que les utilisateurs standard peuvent uniquement consulter la liste des films. L'interface est conçue pour être simple et intuitive. Cette application est idéale pour organiser une bibliothèque de films avec des accès adaptés à chaque rôle.

Fonctionnalités:
Ajouter un film : Saisissez les détails d'un film (titre, genre, durée, image, etc.).
Consulter la liste des films : Affichez les films disponibles.
Modifier un film : Mettez à jour les informations d'un film existant.
Supprimer un film : Retirez un film de la collection.
Rechercher un film : Trouvez rapidement un film à l'aide d'un champ de recherche.
Technologies utilisées
Ajouter une série : Saisissez les détails d'une série(titre, genre, durée, image,nombre de saisons, etc.).
Consulter la liste des séries : Affichez les séries disponibles.
Modifier une série : Mettez à jour les informations d'une série existant.
Supprimer une série 
Rechercher une série
Technologies utilisées
Frontend : HTML, CSS, JavaScript pour l'interface utilisateur.
Backend : PHP pour le traitement côté serveur.
Base de données :PHPMyAdmin pour stocker les données des films.

TABLES BASE DE DONNEES:

Table : film
tit : varchar(25) NOT NULL
url : varchar(225) NOT NULL
duree : varchar(25) NOT NULL
imgs : varchar(225) NOT NULL
categorieS : varchar(30) NOT NULL

Table : serie
tit : varchar(20) NOT NULL
url : varchar(225) NOT NULL
nbs : int(3) NOT NULL
imgs : varchar(225) NOT NULL
categorieS : varchar(25) NOT NULL

Table : users
username : varchar(225) NOT NULL
number : int(225) NOT NULL
Email : varchar(30) NOT NULL
password : varchar(30) NOT NULL
role : varchar(30) NOT NULL

Auteur
Nom : Zeineb Cheffi
Email : cheffizeineb@gamil.com
