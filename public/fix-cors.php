<?php
// fix-cors.php
$url = 'https://booking.sofrimpongtransport.com' . $_SERVER['REQUEST_URI'];

// Get request method
$method = $_SERVER['REQUEST_METHOD'];

// Prepare headers
$headers = [
    'Content-Type: application/json',
    'Authorization: ' . ($_SERVER['HTTP_AUTHORIZATION'] ?? '')
];

// Handle OPTIONS (preflight)
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    header('Access-Control-Allow-Credentials: true');
    http_response_code(200);
    exit;
}

// Forward the request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

if ($method === 'POST' || $method === 'PUT') {
    $data = file_get_contents('php://input');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
}

$response = curl_exec($ch);

// Add CORS headers to response
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

echo $response;
curl_close($ch);