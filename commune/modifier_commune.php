<?php

// Récupérer les données à partir de la requête
$ID = $_GET["id"];
$nv_id = $_POST["id"];
$nv_nom_commune = $_POST["nom"];
$nv_x = $_POST["x"];
$nv_y = $_POST["y"];
$nv_wilaya = $_POST["wilaya"];
// Paramètres de connexion à la base de données

include '../index.php';

// Requête SQL pour mettre à jour l'entrée
$requete = "UPDATE commune SET id_commune = $nv_id ,Nom_commune = '$nv_nom_commune ',Coordonne_X = $nv_x ,Coordonne_Y=$nv_y ,Wilaya='$nv_wilaya ' where id_commune=$ID";
$conn->query($requete);

// Fermeture de la connexion
$conn->close();

// Redirection vers la page d'affichage de la liste
header("Location:liste_commune.php");
exit();
?>