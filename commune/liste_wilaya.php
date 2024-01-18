<?php


// Connexion à la base de données
include '../index.php';

// Requête SQL pour récupérer la liste
$requete = "SELECT * FROM wilaya";
$resultat = $conn->query($requete);

// Exemple de récupération des données depuis une table "votre_table"
$liste = [];

// Traitement des résultats et ajout à la liste
if ($resultat->num_rows > 0) {
    while ($ligne = $resultat->fetch_assoc()) {
        $liste[] = $ligne;
    }
}

// Fermeture de la connexion
$conn->close();

// Afficher la liste en format JSON
echo json_encode($liste);
?>