<?php
require_once '../../utils/autoload.php';
require_once  '../../utils/authMiddleware.php';

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $decoded = getDecodedToken();
    echo json_encode($decoded->user_info);
} else {
    http_response_code(403);
    echo json_encode(['message' => 'Access Forbidden']);
}
