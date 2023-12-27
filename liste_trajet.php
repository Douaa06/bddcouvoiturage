<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trajet</title>
</head>
<body>
<form action="idex.php" method="get">
        <button type="submit" style="color: white; background-color:rgba(10, 155, 0, 0.5); padding: 10px;">retour</button>
</form>
<?php
 $host='localhost';
 $user='root';
 $pass='';
 $db='couvoiturage';
 $conn=mysqli_connect($host, $user, $pass, $db);
 $r = mysqli_query($conn, 'select * from trajet');


 if ($r->num_rows > 0) {
    echo "<h1>Les chauffeur:</h1>";
    while ($row = $r->fetch_assoc()) {
        echo  "</br> ".$row["Nom"]."</t> ". $row["Prenom"] ;
    }
} else {
    echo "Aucun résultat trouvé dans la table.";
}
echo "<h2>Formulaire d insertion</h2>";


 
 

</body>
</html>