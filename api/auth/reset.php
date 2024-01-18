<?php
require_once  __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/firebase/php-jwt/src/JWT.php';
require_once __DIR__ . '/../vendor/firebase/php-jwt/src/Key.php';

require_once '../../../utils/autoload.php';

use Controllers\UserController;
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
    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['reset_token'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Bad Request']);
        return;
    }

    $email = htmlspecialchars($_POST['email']);
    $newPassword = htmlspecialchars($_POST['new_password']);
    $resetToken = htmlspecialchars($_POST['reset_token']);

    // Vérifiez si le jeton de réinitialisation de mot de passe est valide
    if (UserController::validateResetToken($email, $resetToken)) {
        // Appel de la fonction pour mettre à jour le mot de passe
        if (UserController::updatePasswordByEmail($email, $password)) {
            // Supprimez le jeton de réinitialisation de mot de passe après utilisation (vous devez supprimer la colonne de la base de données)
            UserController::removeResetToken($email);

            http_response_code(200);
            echo json_encode(['message' => 'Password reset successful', 'success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Internal Server Error', 'success' => false]);
        }
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Invalid reset token', 'success' => false]);
    }
} else {
    http_response_code(403);
    echo json_encode(['message' => 'Access Forbidden']);
}