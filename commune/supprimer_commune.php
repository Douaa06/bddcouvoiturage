<?php
// Connexion à la base de données
include '../index.php';

$ID = $_GET['id'];
mysqli_query($conn, "DELETE FROM commune WHERE id_commune=$ID ");
header ('location: liste_commune.php');
$conn->close();
 ?>