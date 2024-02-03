<?php
include '../index.php';

$Passagere =  $_GET["passagere"];
$requete = "select * from reservation where Passagere=$Passagere";
$resultat = $conn->query($requete);
// Set the header to indicate JSON response


if ($resultat->num_rows > 0) {
    $reservations = array();

    while ($row = mysqli_fetch_assoc($r)) {
        $reservations[] = $row;
    }

    echo json_encode($reservations);
} else {
    echo json_encode(array("message" => "Aucun résultat trouvé dans la table."));
}

mysqli_close($conn);
?>