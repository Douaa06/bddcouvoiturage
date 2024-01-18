<?php
require_once  __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/firebase/php-jwt/src/JWT.php';
require_once __DIR__ . '/../vendor/firebase/php-jwt/src/Key.php';

require_once '../../../utils/autoload.php';

use Utils\Database;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

// En-têtes CORS
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

// Gestion des pré-vérifications CORS (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Checking if parameters are set
    if (empty($_POST['email']) || empty($_POST['password'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Bad Request']);
        return;
    }

    $email = $_POST['email'];
    $password = htmlspecialchars($_POST['password']);

    // Check if the email exists
    $db = Database::getInstance();
    $emailExistsQuery = "SELECT * FROM utilisateur WHERE email = '$email'";
    $emailExistsResult = $db->query($emailExistsQuery);

    if ($emailExistsResult->num_rows === 0) {
        http_response_code(404);
        echo json_encode(['message' => 'Email not found', 'success' => false]);
        return;
    }

    // Appel de la fonction pour mettre à jour le mot de passe
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $updatePasswordQuery = "UPDATE utilisateur SET password = '$passwordHash' WHERE email = '$email'";
    $result = $db->query($updatePasswordQuery);

    if ($result) {
        http_response_code(200);
        echo json_encode(['message' => 'Password reset successful', 'success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Internal Server Error', 'success' => false]);
    }
} else {
    http_response_code(403);
    echo json_encode(['message' => 'Access Forbidden']);
}
?>
