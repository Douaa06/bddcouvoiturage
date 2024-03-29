<?php

use Controllers\ReservationController;
use Controllers\TrajetController;
use Controllers\UserController;

require_once '../../../utils/autoload.php';

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

if ($method === 'GET') {
    if (empty($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['message' => "Bad Request"]);
        return;
    }
    $user_id = htmlspecialchars($_GET['id']);
    if (!UserController::userExist($user_id)) {
        http_response_code(400);
        echo json_encode(['message' => 'Utilisateur does not exists', 'success' => false]);
        return;
    }
    $trajets = ReservationController::getReservationsByUser($user_id);
    echo json_encode($trajets);
}
else if ($method === 'DELETE') {
    $params = ['user_id', 'trajet_id'];
    foreach ($params as $param) {
        if (empty($data[$param])) {
            http_response_code(400);
            echo json_encode(['message' => "Bad Request $param"]);
            return;
        }
        $data[$param] = htmlspecialchars($data[$param]);
    }
    $user_id = $data['user_id'];
    $trajet_id = $data['trajet_id'];
    //check if exists
    if (!TrajetController::trajetExist($trajet_id)) {
        http_response_code(400);
        echo json_encode(['message' => 'Trajet does not exists', 'success' => false]);
        return;
    }
    if (!UserController::userExist($user_id)) {
        http_response_code(400);
        echo json_encode(['message' => 'User does not exists', 'success' => false]);
        return;
    }
    if (!ReservationController::reservationExist($trajet_id, $user_id)) {
        http_response_code(400);
        echo json_encode(['message' => 'You did not reserve this Trajet', 'success' => false]);
        return;
    }
    if (ReservationController::deleteReservation($trajet_id, $user_id)) {
        http_response_code(200);
        echo json_encode(['message' => 'Trajet deleted successfully', 'success' => true]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Failed to delete Trajet', 'success' => false]);
    }
}
else {
    http_response_code(403);
    echo json_encode(['message' => 'Access Forbidden']);
}
