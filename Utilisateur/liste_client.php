<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client</title>
</head>
<body>
<form action="../home.php" method="get">
        <button type="submit" style="color: white; background-color:rgba(10, 155, 0, 0.5); padding: 10px;">retour</button>
</form>
<?php
 $host='localhost';
 $user='root';
 $pass='';
 $db='couvoiturage';
 $conn=mysqli_connect($host, $user, $pass, $db);

 $r = mysqli_query($conn, 'select * from utilisateur where Role="client"');


 if ($r->num_rows > 0) {
    echo "<h1>Les client:</h1>";
    while ($row = $r->fetch_assoc()) {
        echo   "
        </br> 
        <h3>$row[Nom]  $row[Prenom] </h3>
        <a href='mod_client.php? id=$row[Matrecule]'>modifier</a></t>
        <a href='supp_client.php? id=$row[Matrecule]'>supprimer</a></t>
        <a href=''>details</a></br>
        ";
    }
} else {
    echo "Aucun résultat trouvé dans la table.";
}

echo "<h2>Formulaire de insertion</h2>";

?>

<form action="inserer.php"method="post" >
    <label for="nom">Matrecule :</label>
    <input type="number" name="mat" pattern="\d{12}" placeholder="anne de bac + matrcule" required><br>

    <label for="nom">Nom :</label>
    <input type="text" name="nom" required><br>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" required><br>

    <label for="email">Email :</label>
    <input type="email" name="email" required><br>

    <label for="psw">Password:</label>
    <input type="password" name="psw" required><br>

    <label for="tlf">Telephone :</label>
    <input type="number" name="tlf" pattern="\d{10}"required><br>

    <input type="submit" name="ajoutcl" value="Insérer un client">
</form>


 
 

</body>
</html>