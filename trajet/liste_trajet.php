<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'couvoiturage';
$conn = mysqli_connect($host, $user, $pass, $db);

$r = mysqli_query($conn, 'select * from trajet');

// Set the header to indicate JSON response
header('Content-Type: application/json');

if ($r->num_rows > 0) {
    $trajets = array();

    while ($row = mysqli_fetch_assoc($r)) {
        $trajets[] = $row;
    }

    echo json_encode($trajets);
} else {
    echo json_encode(array("message" => "Aucun résultat trouvé dans la table."));
}

mysqli_close($conn);
?>