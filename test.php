
/*
// Prepare an UPDATE statement with placeholders
$stmt = $conn->prepare("UPDATE your_table SET status = ? WHERE user_id = ?");

// Bind parameters to the statement
$stmt->bind_param("si", $new_status, $user_id);

// Execute the statement
$stmt->execute();

// Check for success
if ($stmt->affected_rows > 0) {
    echo "Update successful!";
} else {
    echo "Update failed!";
}

// Close the statement and connection
$stmt->close();

$row = $result->fetch_assoc()
*/
<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'couvoiturage';

// Nom du fichier de sauvegarde
$backup_file = 'bdd.sql';

// Construire la commande mysqldump
$command = "mysqldump --host={$host} --user={$user} --password={$pass} {$db} > {$backup_file}";

// Exécuter la commande
$output = shell_exec($command);

// Vérifier s'il y a eu une erreur
if ($output === null) {
    echo "La sauvegarde a échoué. Vérifiez les paramètres de connexion.";
} else {
    echo "La sauvegarde a été créée avec succès dans le fichier {$backup_file}.";
}
?>