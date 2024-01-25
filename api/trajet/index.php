<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/utils/autoload.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/utils/authMiddleware.php';

use Controllers\CommuneController;
use Controllers\TrajetController;
use Controllers\UserController;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Checking if parameters are set
    $params = ['chauffeur', 'commune_depart', 'commune_arrive', 'date_depart', 'heure_depart', 'hebdomadaire', 'nbr_place'];
    foreach ($params as $param) {
        if (empty($_POST[$param])) {
            http_response_code(400);
            echo json_encode(['message' => "Bad Request $param"]);
            return;
        }
    }

    // Retrieving parameters
    $chauffeur = htmlspecialchars($_POST['chauffeur']);
    $commune_depart = htmlspecialchars($_POST['commune_depart']);
    $commune_arrive = htmlspecialchars($_POST['commune_arrive']);
    $hebdomadaire = htmlspecialchars($_POST['hebdomadaire']);
    $nbr_place = intval(htmlspecialchars($_POST['nbr_place']));
    $date_depart =  date('Y-m-d', strtotime(htmlspecialchars($_POST['date_depart'])));
    $heure_depart =  date('H:i:s', strtotime(htmlspecialchars($_POST['heure_depart'])));

    // TODO: pas de trajet vers meme commune
    // Validating parameters
    if (!UserController::userExist($chauffeur)) {
        http_response_code(400);
        echo json_encode(['message' => 'Chauffeur does not exists', 'success' => false]);
        return;
    }

    if (!CommuneController::communeExist($commune_depart) || !CommuneController::communeExist($commune_arrive)) {
        http_response_code(400);
        echo json_encode(['message' => 'Commune does not exists', 'success' => false]);
        return;
    }

    // TODO: check max available places as defined by admin
    if ($nbr_place < 1) {
        http_response_code(400);
        echo json_encode(['message' => 'Wrong available place number', 'success' => false]);
        return;
    }

    if(!$date_depart || !$heure_depart) {
        http_response_code(400);
        echo json_encode(['message' => 'Wrong date time format', 'success' => false]);
        return;
    }

    if ($hebdomadaire !== '0' && $hebdomadaire !== '1') {
        http_response_code(400);
        echo json_encode(['message' => 'Wrong hebdomadaire format', 'success' => false]);
        return;
    }

    if(TrajetController::createTrajet($chauffeur, $commune_depart, $commune_arrive, $date_depart, $heure_depart, $hebdomadaire, $nbr_place)) {
        http_response_code(200);
        echo json_encode(['message' => 'Trajet inserted successfully', 'success' => true]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Failed to insert Trajet', 'success' => false]);
    }
} else {
    http_response_code(403);
    echo json_encode(['message' => 'Access Forbidden']);
}
