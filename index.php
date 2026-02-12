<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'config/Database.php';
require_once 'models/Product.php';
require_once 'controllers/ProductController.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$controller = new ProductController($product);

// Get request method and URI
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// Route handling
if ($method === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// API endpoints
if (isset($uri[2]) && $uri[2] === 'products') {
    $id = isset($uri[3]) ? $uri[3] : null;
    
    switch($method) {
        case 'GET':
            if ($id) {
                $controller->getProduct($id);
            } else {
                $controller->getProducts();
            }
            break;
        case 'POST':
            $controller->createProduct();
            break;
        case 'PUT':
            if ($id) {
                $controller->updateProduct($id);
            }
            break;
        case 'DELETE':
            if ($id) {
                $controller->deleteProduct($id);
            }
            break;
        default:
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']);
    }
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Endpoint not found']);
}
?>
