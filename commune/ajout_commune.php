<?php 
include '../index.php';
    // Récupérer les données du formulaire
   
    $id =  $_POST["id"];
    $nom = $_POST["nom"];
    $x =  $_POST["x"];
    $y =  $_POST["y"];
    $wilaya =  $_POST["wilaya"];
    // Requête SQL pour insérer une nouvelle ligne dans la table (à ajuster selon votre cas)
    $sql = "INSERT INTO commune VALUES ($id, '$nom', $x, $y, '$wilaya')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvelle ligne insérée avec succès.";
    } else {
        echo "Erreur lors de l'insertion de la ligne : " . $conn->error;
    }  
    $conn->close();

?>
