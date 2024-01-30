<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
use Firebase\JWT\JWT;
use Dotenv\Dotenv;
use Firebase\JWT\Key;

$dotenv = Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
$dotenv->load();

$jwt = str_replace('Bearer ', '', getAuthorizationHeader());

if (!$jwt) {
    http_response_code(401);
    echo json_encode(['message' => 'Missing token', 'success' => false]);
    exit;
}
$decoded = null;
try {
    $decoded = JWT::decode($jwt, new Key($_ENV['JWT_SECRET'], 'HS256'));
} catch (Exception $e) {
    http_response_code(401);
    echo json_encode(['message' => 'Invalid token', 'success' => false]);
    exit;
}

function getDecodedToken(): ?object
{
    global $decoded;
    return $decoded;
}

function getAuthorizationHeader(): ?string
{
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}