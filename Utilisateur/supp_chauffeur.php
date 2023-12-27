<?php
 $host='localhost';
 $user='root';
 $pass='';
 $db='couvoiturage';
 $conn=mysqli_connect($host, $user, $pass, $db);
 $ID = $_GET['id'];
mysqli_query($conn, "DELETE FROM utilisateur WHERE Matrecule=$ID");
header ('location: liste_chauffeur.php');
$conn.close();
 ?>
                   I
