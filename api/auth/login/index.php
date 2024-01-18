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
    if (empty($_POST['email']) || empty($_POST['password'])) {
        http_response_code(400);
        echo json_encode(['message' => 'Bad Request']);
        return;
    }


        // Retrieving parameters
        $email = $_POST['email'];
        $password = $_POST['password'];
        $mat = null;
    if (UserController::authenticate($email, $password)) {
        $sec_key= 'wesselni';
        $key = new Key($sec_key, 'HS256');
        
  
        $payload = [
            "iss" => "http://localhost/api/auth/login/index.php",  // URL de votre service ou script PHP
            "aud" => "http://localhost:4200",  // URL de votre application Angular
            "iat" => time(),
            "exp" => time() + 3600,  // Expiration dans 1 heure
            "sub" => $mat,  // Remplacez par l'identifiant de l'utilisateur
        ];

      
         $token = JWT::encode($payload, $sec_key, 'HS256');
           
    
      //   $decode = JWT::decode($token, new Key($sec_key, 'HS256'));
        
    

        http_response_code(200);
        echo json_encode(['message' => 'Login successful', 'success' => true, 'token' => $token]);
      //  echo json_encode(['user' => $token]);
     
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Login failed', 'success' => false]);
    }
} else {
    http_response_code(403);
    echo json_encode(['message' => 'Access Forbidden']);
}