<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chauffeur</title>
    
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
 $ID= $_GET['id'];
 $up = mysqli_query($conn, "select * from utilisateur WHERE Matrecule=$ID")
 $data = mysqli_fetch_array($up);



echo "<h2>Modifier </h2>";




?>
<form method="post" >
    <label for="nom">Matrecule :</label>
    <input type="number" name="mat" pattern="\d{12}" value=" <?php echo $data['Matrecule']?>" required><br>

    <label for="nom">Nom :</label>
    <input type="text" name="nom" value=" <?php echo $data['Nom']?>"required><br>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" value=" <?php echo $data['Prenom']?>"required><br>

    <label for="email">Email :</label>
    <input type="email" name="email" value=" <?php echo $data['Email']?>"required><br>

    <label for="psw">Password:</label>
    <input type="password" name="psw" value=" <?php echo $data['Password']?>"required><br>

    <label for="tlf">Telephone :</label>
    <input type="number" name="tlf" pattern="\d{10}" value=" <?php echo $data['Telephone']?>"required><br>

    <input type="submit" name="update" value="confermer">
</form>

<?php 

// Vérifier si le formulaire a été soumis
if (isset($_POST["update"])) {
    // Récupérer les données du formulaire
    $mat = $_POST["mat"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $psw = $_POST["psw"];
    $tlf = $_POST["tlf"];
    
    $conn2 = new mysqli($host, $user, $pass, $db);
   
    // Requête SQL pour insérer une nouvelle ligne dans la table (à ajuster selon votre cas)
    $update = "UPDATE utilisateur SET Matrecule='$mat',Nom='$nom',Prenom= '$prenom',Email='$email', Password='$psw',Telephone= $tlf,Role='client' ";

    if ($conn2->query($update) === TRUE) {
        echo "<h3 style='color: red;'>modifier ligne insérée avec succès.</h3>";
    } else {
        echo "<h3 style='color: red;'>Erreur lors de la modification de la ligne :</h3> " . $conn->error;
    }
    header('location:liste_client.php');
    // Fermer la connexion
    

}
?>


</body>
</html>