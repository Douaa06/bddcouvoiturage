<?php
// Connexion à la base de données
$ID_trajet = $_GET["id"];
$Passagere =  $_GET["passagere"];

mysqli_query($conn, "DELETE FROM reservation WHERE Trajet=$ID_trajet and passagere=$Passagere ");
header ('location: liste_reservation.php');
$conn->close();
 ?>