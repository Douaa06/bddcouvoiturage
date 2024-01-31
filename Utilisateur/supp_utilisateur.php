<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'couvoiturage';

// Connexion à la base de données
$conn = new mysqli($host, $user, $pass, $db);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupérer l'ID depuis les paramètres GET
$ID = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Utiliser une requête préparée pour éviter l'injection SQL
$stmt = $conn->prepare("DELETE FROM utilisateur WHERE id = ?");
$stmt->bind_param("i", $ID);

// Exécuter la requête
if ($stmt->execute()) {
    $_SESSION['delete_message'] = "L'utilisateur avec l'ID $ID a été supprimé.";
} else {
    $_SESSION['delete_message'] = "Erreur lors de la suppression de l'utilisateur avec l'ID $ID : " . $conn->error;
}

// Fermer la requête et la connexion
$stmt->close();
$conn->close();

// Rediriger vers la page liste_chauffeur.php
header('location: liste_utilisateur.php');
?>

                   I
