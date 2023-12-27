<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
</head>
<body>
<form action="index.php" method="get">
        <button type="submit" style="color: white; background-color:rgba(10, 155, 0, 0.5); padding: 10px;">retour</button>
</form>
<?php
 $host='localhost';
 $user='root';
 $pass='';
 $db='couvoiturage';
 $conn=mysqli_connect($host, $user, $pass, $db);
 $r = mysqli_query($conn, 'select * from reservation ');


 if ($r->num_rows > 0) {
    echo "<h1>Les chauffeur:</h1>";
    while ($row = $r->fetch_assoc()) {
        echo   "
        </br> 
        <h3>$row[Passagere]  $row[Chauffeur] </h3>
        <a href=''>modifier</a></t>
        <a href=''>supprimer</a></t>
        <a href=''>details</a></br>
        ";
    }
    }
     else {
    echo "Aucun résultat trouvé dans la table";}
 
?> 

</body>
</html>