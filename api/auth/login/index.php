<?php
require_once '../../../utils/autoload.php';
use Controllers\UserController;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Checking if parameters are set
    if (empty($_POST['email']) || empty($_POST['password'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Bad Request']);
        return;
    }

    // Retrieving parameters
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(UserController::authenticate($email, $password)) {
        http_response_code(200);
        echo json_encode(['message' => 'Login successful', 'success' => true]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Login failed', 'success' => false]);
    }
} else {
    http_response_code(403);
    echo json_encode(['message' => 'Access Forbidden']);
}
