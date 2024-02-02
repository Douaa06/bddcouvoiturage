<?php 
include '../index.php';
    // Récupérer les données du formulaire
    $ID_trajet = $_GET["id"];
    $Passagere =  $_GET["passagere"];
    
    // Requête SQL pour insérer une nouvelle ligne dans la table (à ajuster selon votre cas)
    $sql = "INSERT INTO reservation  VALUES ($Passagere,$ID_trajet,0)";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvelle ligne insérée avec succès.";
    } else {
        echo "Erreur lors de l'insertion de la ligne : " . $conn->error;
    }  
    $conn->close();

?>