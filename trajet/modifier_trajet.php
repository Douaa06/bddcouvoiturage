<?php

// Récupérer les données à partir de la requête
$ID = $_GET["id"];
   
$chauffeur =  $_POST["chauffeur"];
$lieu_depart = $_POST["lieu_depart"];
$lieu_arrive =  $_POST["lieu_arrive"];
$date_depart =  $_POST["date_depart"];
$heure_depart =  $_POST["heure_depart"];
$hobdomadaire =  $_POST["hobdomadaire"];
$nb_place =  $_POST["nb_place"];
// Paramètres de connexion à la base de données

include '../index.php';

// Requête SQL pour mettre à jour l'entrée
$requete = "UPDATE trajet SET Chauffeur=$chauffeur,Lieu_depar= $lieu_depart, Lieu_arrive=$lieu_arrive, Date_depart=$date_depart,Heure_depart=$heure_depart,hobdomadaire=$hobdomadaire, Nbr_place_max=$nb_place where id_trajet=$ID";
$conn->query($requete);

// Fermeture de la connexion
$conn->close();

// Redirection vers la page d'affichage de la liste
header("Location:liste_trajet.php");
exit();
?>