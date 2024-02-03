<?php
// Connexion à la base de données
include '../index.php';

$ID = $_GET['wilaya'];
mysqli_query($conn, "DELETE FROM wilaya WHERE Nom_wilaya='$ID' ");
header ('location: liste_wilaya.php');
$conn->close();
 ?>