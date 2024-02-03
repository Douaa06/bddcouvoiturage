<?php 
include '../index.php';
    // Récupérer les données du formulaire
    $wilaya = $_POST["wilaya"];
   
    // Requête SQL pour insérer une nouvelle ligne dans la table (à ajuster selon votre cas)
    $sql = "INSERT INTO wilaya VALUES ('$wilaya')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvelle ligne insérée avec succès.";
    } else {
        echo "Erreur lors de l'insertion de la ligne : " . $conn->error;
    }


    
    $conn->close();

?>
