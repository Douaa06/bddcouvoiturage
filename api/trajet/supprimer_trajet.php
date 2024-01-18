<?php
// Connexion à la base de données
include 'index.php';

$ID = $_GET['id'];
mysqli_query($conn, "DELETE FROM trajet WHERE id_trajet=$ID ");
header ('location: liste_trajet.php');
$conn->close();
 ?>