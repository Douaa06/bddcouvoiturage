<?php 
include '../index.php';
    // Récupérer les données du formulaire
   
    $chauffeur =  $_POST["chauffeur"];
    $lieu_depart = $_POST["lieu_depart"];
    $lieu_arrive =  $_POST["lieu_arrive"];
    $date_depart =  $_POST["date_depart"];
    $heure_depart =  $_POST["heure_depart"];
    $nb_place =  $_POST["nb_place"];
    // Requête SQL pour insérer une nouvelle ligne dans la table (à ajuster selon votre cas)
    $sql = "INSERT INTO trajet VALUES (,$chauffeur, $lieu_depart, $lieu_arrive, $date_depart,$heure_depart, $nb_place)";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvelle ligne insérée avec succès.";
    } else {
        echo "Erreur lors de l'insertion de la ligne : " . $conn->error;
    }  
    $conn->close();

?>