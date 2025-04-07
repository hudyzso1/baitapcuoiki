<?php
session_start();

require_once 'app/models/ProductModel.php';
require_once 'app/helpers/SessionHelper.php';
require_once 'app/controllers/ProductApiController.php';
require_once 'app/controllers/CategoryApiController.php';

// Route URL requests
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$urlParts = explode('/', $url);

// Determine controller and action
$controllerName = isset($urlParts[0]) && $urlParts[0] !== '' ? ucfirst($urlParts[0]) . 'Controller' : 'DefaultController';
$action = isset($urlParts[1]) && $urlParts[1] !== '' ? $urlParts[1] : 'index';

// API Routing
if ($controllerName === 'ApiController' && isset($urlParts[1])) {
    $apiControllerName = ucfirst($urlParts[1]) . 'ApiController';
    $apiControllerPath = 'app/controllers/' . $apiControllerName . '.php';

    if (file_exists($apiControllerPath)) {
        require_once $apiControllerPath;
        $controller = new $apiControllerName();
        $method = $_SERVER['REQUEST_METHOD'];
        $id = $urlParts[2] ?? null;

        switch ($method) {
            case 'GET':
                $action = $id ? 'show' : 'index';
                break;
            case 'POST':
                $action = 'store';
                break;
            case 'PUT':
                if ($id) {
                    $action = 'update';
                }
                break;
            case 'DELETE':
                if ($id) {
                    $action = 'destroy';
                }
                break;
            default:
                http_response_code(405);
                echo json_encode(['message' => 'Method Not Allowed']);
                exit;
        }

        if (method_exists($controller, $action)) {
            call_user_func_array([$controller, $action], $id ? [$id] : []);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Action not found']);
        }
        exit;
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Controller not found']);
        exit;
    }
}

// Non-API Routing
$controllerPath = 'app/controllers/' . $controllerName . '.php';

if (file_exists($controllerPath)) {
    require_once $controllerPath;
    $controller = new $controllerName();
} else {
    die('Controller not found');
}

if (method_exists($controller, $action)) {
    call_user_func_array([$controller, $action], array_slice($urlParts, 2));
} else {
    die('Action not found');
}
?>