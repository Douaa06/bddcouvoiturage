<?php
require_once '../../utils/autoload.php';
require_once  '../../utils/authMiddleware.php';

use Controllers\UserController;

$method = $_SERVER['REQUEST_METHOD'];
if($method === 'GET') {
    $decoded = getDecodedToken();
    echo json_encode($decoded->user_info);
} else if ($method === 'POST') {
    $params = ['firstname', 'lastname', 'email', 'telephone', 'password'];
    foreach ($params as $param) {
        if (empty($_POST[$param])) {
            http_response_code(400);
            echo json_encode(['message' => 'Bad Request']);
            return;
        }
    }
    $decoded = getDecodedToken();
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $password = htmlspecialchars($_POST['password']);

    // Validating parameters
    if (!preg_match('/^[a-zA-Z]+$/', $firstname) || !preg_match('/^[a-zA-Z]+$/', $lastname)) {
        http_response_code(400);
        echo json_encode(['message' => 'Firstname and Lastname must contain only letters', 'success' => false]);
        return;
    }

    if (strlen($password) < 8) {
        http_response_code(400);
        echo json_encode(['message' => 'Password must be at least 8 characters', 'success' => false]);
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid email', 'success' => false]);
        return;
    }

    if (!preg_match('/^0\d{9}$/', $telephone)) {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid phone number', 'success' => false]);
        return;
    }

    if (UserController::checkEmailForUpdate($email, $decoded->user_info)) {
        http_response_code(400);
        echo json_encode(['message' => 'User with same email exist', 'success' => false]);
        return;
    }

    if (UserController::checkPhoneForUpdate($telephone, $decoded->user_info)) {
        http_response_code(400);
        echo json_encode(['message' => 'User with same phone number exist', 'success' => false]);
        return;
    }

    $data = [
        'prenom' => $firstname,
        'nom' => $lastname,
        'email' => $email,
        'telephone' => $telephone,
        'password' => $password
    ];

    if (UserController::updateUser($decoded->user_info->id, $data)) {
        echo json_encode(['message' => 'User updated successfully', 'success' => true]);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'User not updated', 'success' => false]);
    }
} else {
    http_response_code(403);
    echo json_encode(['message' => 'Access Forbidden']);
}
