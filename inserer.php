<?php 
 $host='localhost';
 $user='root';
 $pass='';
 $db='couvoiturage';
 $conn2 = new mysqli($host, $user, $pass, $db);
// Vérifier si le formulaire a été soumis
if (isset($_POST["ajoutch"])) {
    // Récupérer les données du formulaire
    $mat = $_POST["mat"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $psw = $_POST["psw"];
    $tlf = $_POST["tlf"];
    
   
   
    // Requête SQL pour insérer une nouvelle ligne dans la table (à ajuster selon votre cas)
    $sql = "INSERT INTO utilisateur VALUES ('$mat','$nom', '$prenom','$email', '$psw', $tlf,'chauffeur')";

    if ($conn2->query($sql) === TRUE) {
        echo "<h3 style='color: red;'>Nouvelle ligne insérée avec succès.</h3>";
    } else {
        echo "<h3 style='color: red;'>Erreur lors de l'insertion de la ligne :</h3> " . $conn->error;
    }

    header('location:liste_chauffeur.php');
    // Fermer la connexion
    

}


// Vérifier si le formulaire a été soumis
if (isset($_POST["ajoutcl"])) {
    // Récupérer les données du formulaire
    $mat = $_POST["mat"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $psw = $_POST["psw"];
    $tlf = $_POST["tlf"];
    
   
   
    // Requête SQL pour insérer une nouvelle ligne dans la table (à ajuster selon votre cas)
    $sql = "INSERT INTO utilisateur VALUES ('$mat','$nom', '$prenom','$email', '$psw', $tlf,'client')";

    if ($conn2->query($sql) === TRUE) {
        echo "<h3 style='color: red;'>Nouvelle ligne insérée avec succès.</h3>";
    } else {
        echo "<h3 style='color: red;'>Erreur lors de l'insertion de la ligne :</h3> " . $conn->error;
    }

    // Fermer la connexion
    
    header('location:liste_client.php');
}
?>