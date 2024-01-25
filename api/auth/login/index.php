<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/utils/autoload.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
use Controllers\UserController;
use Firebase\JWT\JWT;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
$dotenv->load();

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

    if(!UserController::emailExist($email)) {
        http_response_code(400);
        echo json_encode(['message' => 'E-mail does not exist', 'success' => false]);
        return;
    }

    if(UserController::authenticate($email, $password)) {
        $payload = [
            'iat' => time(),
            'iss' => 'dev.covoiturage.com',
            'exp' => time() + (60*60*24), // token valid for 1 day
            'email' => $email
        ];
        $jwt = JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');
        http_response_code(200);
        echo json_encode(['message' => 'Login successful', 'success' => true, 'token' => $jwt]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Wrong Password', 'success' => false]);
    }
} else {
    http_response_code(403);
    echo json_encode(['message' => 'Access Forbidden']);
}
