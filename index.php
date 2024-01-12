<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
require_once('vendor/autoload.php');
$body = file_get_contents("php://input");
$data = json_decode($body, true);

$routes = require_once('src/api/routes/api.php');
$route = $_SERVER['REQUEST_URI'];
$basePath = '/src';
if (str_starts_with($route, $basePath)) {
    $route = substr($route, strlen($basePath));
}

try {

    if (!array_key_exists($route, $routes)) {
        throw new InvalidRouteException('Invalid Route');
    }
    $controllerName = $routes[$route];
    $controller = new $controllerName();
} catch (InvalidRouteException) {
    http_response_code(404);
    echo json_encode(['message' => 'Page not found']);
    exit();
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $controller->getAll();
        break;
    case 'POST':
        $controller->create($data);
        break;
    case 'PATCH':
        $controller->update($data);
        break;
    case 'DELETE':
        $controller->delete($data);
        break;
    default:
        http_response_code(405);
        echo json_encode(['message' => 'Invalid method']);
        exit();
}