<?php
// Enable CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Credentials: true");
require_once '../../utils/autoload.php';
require_once  '../../utils/authMiddleware.php';

use Controllers\CommuneController;
use Controllers\ReservationController;
use Controllers\UserController;

$method = $_SERVER['REQUEST_METHOD'];
if($method === 'POST') {
   
    // TODO: pas de Reservation vers meme commune
    // Validating parameters
    if (!UserController::userExist($passagere)) {
        http_response_code(400);
        echo json_encode(['message' => 'passagere does not exists', 'success' => false]);
        return;
    }

   

    if(ReservationController::createReservation($trajet_id,$passagere)) {
        http_response_code(200);
        echo json_encode(['message' => 'Reservation inserted successfully', 'success' => true]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Failed to insert Reservation', 'success' => false]);
    }
} else if ($method === 'GET') {
    $decoded = getDecodedToken();
    $user_id = $decoded->user_info->id;
    $Reservations = ReservationController::getReservationsByUser($user_id);
    echo json_encode($Reservations);
} else if ($method === 'DELETE') {
    $decoded = getDecodedToken();
    $user_id = $decoded->user_info->id;
    $trajet_id = $_GET['id'];
    //check if exists

    if (!ReservationController::ExistResrvation($trajet_id,$passagere)) {
        http_response_code(400);
        echo json_encode(['message' => 'Reservati does not exists', 'success' => false]);
        return;
    }
    if (ReservationController::deleteReservati($trajet_id, $user_id)) {
        http_response_code(200);
        echo json_encode(['message' => 'Reservation deleted successfully', 'success' => true]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Failed to delete Reservation', 'success' => false]);
    }
}
    $trajet_id = $_GET['id'];
    if (UserController::ApprouverReservation($decoded->user_info->id,$trajet_id)) {
        echo json_encode(['message' => 'Approuver reservation successfully', 'success' => true]);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'reservation  not approuved', 'success' => false]);
    }
 else {
    http_response_code(403);
    echo json_encode(['message' => 'Access Forbidden']);
}
