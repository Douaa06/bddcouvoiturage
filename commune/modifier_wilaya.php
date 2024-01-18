<?php
// Récupérer les données à partir de la requête
$wilaya = $_GET["wilaya"];
$nv_nom_wilaya = $_POST["wilaya"];

// Paramètres de connexion à la base de données
include '../index.php';


// Requête SQL pour mettre à jour l'entrée
$requete = "UPDATE wilaya SET Nom_wilaya = '$nv_nom_wilaya' where Nom_wilaya  = '$wilaya'";
$conn->query($requete);

// Fermeture de la connexion
$conn->close();

// Redirection vers la page d'affichage de la liste
header("Location:liste_wilaya.php");
exit();
?>