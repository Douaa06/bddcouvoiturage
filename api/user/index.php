<?php
require_once '../../utils/autoload.php';

use Controllers\UserController;

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

if($method === 'GET') {
    if (empty($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Bad Request', 'success' => false]);
        return;
    }
    $user_id = htmlspecialchars($_GET['id']);
    if (!UserController::userExist($user_id)) {
        http_response_code(400);
        echo json_encode(['message' => 'User does not exist', 'success' => false]);
        return;
    }
    $user = UserController::getUserById($user_id);
    echo json_encode($user);
} else if ($method === 'PUT') {
    $params = ['id', 'firstname', 'lastname', 'email', 'telephone', 'password'];
    foreach ($params as $param) {
        if (empty($data[$param])) {
            http_response_code(400);
            echo json_encode(['message' => "Bad Request $param"]);
            return;
        }
        $data[$param] = htmlspecialchars($data[$param]);
    }

    $user_id = $data['id'];
    $firstname = $data['firstname'];
    $lastname = $data['lastname'];
    $email = $data['email'];
    $telephone = $data['telephone'];
    $password = $data['password'];

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

    if (UserController::checkEmailForUpdate($email, $user_id)) {
        http_response_code(400);
        echo json_encode(['message' => 'User with same email exist', 'success' => false]);
        return;
    }

    if (UserController::checkPhoneForUpdate($telephone, $user_id)) {
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

    if (UserController::updateUser($user_id, $data)) {
        echo json_encode(['message' => 'User updated successfully', 'success' => true]);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'User not updated', 'success' => false]);
    }
} else {
    http_response_code(403);
    echo json_encode(['message' => 'Access Forbidden']);
}
