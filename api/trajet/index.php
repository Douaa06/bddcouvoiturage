<?php

require_once '../../utils/autoload.php';

use Controllers\CommuneController;
use Controllers\TrajetController;
use Controllers\UserController;

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

if($method === 'POST') {
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
} else if ($method === 'GET') {
    if (empty($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['message' => "Bad Request"]);
        return;
    }
    $user_id = htmlspecialchars($_GET['id']);
    $trajets = TrajetController::getTrajetsByUser($user_id);
    echo json_encode($trajets);
} else if ($method === 'PUT') {
    $params = ['id', 'commune_depart', 'commune_arrive', 'date_depart', 'heure_depart', 'hebdomadaire', 'nbr_place'];
    foreach ($params as $param) {
        if (!isset($data[$param])) {
            http_response_code(400);
            echo json_encode(['message' => "Bad Request $param"]);
            return;
        }
        $data[$param] = htmlspecialchars($data[$param]);
    }
    // Retrieving parameters
    $trajet_id = $data['id'];
    $commune_depart = $data['commune_depart'];
    $commune_arrive = $data['commune_arrive'];
    $hebdomadaire = $data['hebdomadaire'];
    $nbr_place = intval($data['nbr_place']);
    $date_depart = date('Y-m-d', strtotime($data['date_depart']));
    $heure_depart = date('H:i:s', strtotime($data['heure_depart']));

    if (!TrajetController::trajetExist($trajet_id)) {
        http_response_code(400);
        echo json_encode(['message' => "Trajet does not exist"]);
        return;
    }

    // TODO: pas de trajet vers meme commune

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

    if (!$date_depart || !$heure_depart) {
        http_response_code(400);
        echo json_encode(['message' => 'Wrong date time format', 'success' => false]);
        return;
    }

    if ($hebdomadaire !== '0' && $hebdomadaire !== '1') {
        http_response_code(400);
        echo json_encode(['message' => 'Wrong hebdomadaire format', 'success' => false]);
        return;
    }

    $data = [
        'Lieu_depart' => $commune_depart,
        'Lieu_arrive' => $commune_arrive,
        'Date_depart' => $date_depart,
        'Heure_depart' => $heure_depart,
        'nbr_place' => $nbr_place,
        'hebdomadaire' => $hebdomadaire
    ];

    if (TrajetController::updateTrajet($trajet_id, $data)) {
        http_response_code(200);
        echo json_encode(['message' => 'Trajet edited successfully', 'success' => true]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Failed to edit Trajet', 'success' => false]);
    }
} else if ($method === 'DELETE') {
    $decoded = getDecodedToken();
    $user_id = $decoded->user_info->id;
    $trajet_id = $_GET['id'];
    //check if exists
    if (!TrajetController::trajetExist($trajet_id)) {
        http_response_code(400);
        echo json_encode(['message' => 'Trajet does not exists', 'success' => false]);
        return;
    }
    if (TrajetController::deleteTrajet($trajet_id, $user_id)) {
        http_response_code(200);
        echo json_encode(['message' => 'Trajet deleted successfully', 'success' => true]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Failed to delete Trajet', 'success' => false]);
    }
} else {
    http_response_code(403);
    echo json_encode(['message' => 'Access Forbidden']);
}
