<?php
 $host='localhost';
 $user='root';
 $pass='';
 $db='couvoiturage';
 $conn=mysqli_connect($host, $user, $pass, $db);
 $ID= $_GET['id'];
mysqli_query ($con, "DELETE FROM utilisateur WHERE Matrecule=$ID");
header ('location: liste_client.php')
 ?>