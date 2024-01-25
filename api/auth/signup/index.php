<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/utils/autoload.php';
use Controllers\UserController;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $params = ['firstname', 'lastname', 'email', 'password', 'telephone'];
    foreach ($params as $param) {
        if (empty($_POST[$param])) {
            http_response_code(400);
            echo json_encode(['message' => 'Bad Request']);
            return;
        }
    }
    // Retrieving parameters
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $telephone = htmlspecialchars($_POST['telephone']);

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

    if (UserController::emailExist($email)) {
        http_response_code(400);
        echo json_encode(['message' => 'User with same email exist', 'success' => false]);
        return;
    }

    if (UserController::phoneExist($telephone)) {
        http_response_code(400);
        echo json_encode(['message' => 'User with same phone number exist', 'success' => false]);
        return;
    }

    if(UserController::createUser($firstname, $lastname, $email, $password, $telephone)) {
        http_response_code(200);
        echo json_encode(['message' => 'Signup successful', 'success' => true]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Signup failed', 'success' => false]);
    }
} else {
    http_response_code(403);
    echo json_encode(['message' => 'Access Forbidden']);
}
