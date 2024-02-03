<?php

// Récupérer les données à partir de la requête
$ID_trajet = $_GET["id"];
$Passagere =  $_GET["passagere"];
// Paramètres de connexion à la base de données

include '../index.php';

// Requête SQL pour mettre à jour l'entrée
$requete = "UPDATE reservation SET Approuver=1 where Trajet=$ID_trajet and Passagere=$Passagere";
$conn->query($requete);

// Fermeture de la connexion
$conn->close();

// Redirection vers la page d'affichage de la liste

exit();
?>