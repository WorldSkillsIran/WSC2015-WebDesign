<?php
spl_autoload_extensions('.php');
spl_autoload_register();

use Application\Exception\NotFoundException;
use Utilities\Router;

$baseUrl = dirname($_SERVER['SCRIPT_NAME']);
$uri = preg_replace('#' . $baseUrl . '#', '', $_SERVER['REQUEST_URI'], 1);
$uri = trim($uri, '/');
$uri = '/' . $uri;
$uri = explode('?', $uri)[0];

define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/' . trim($baseUrl, '/') . '/');

try {
    $router = new Router();
    $router->import();
    $router->route($uri);
} catch (NotFoundException $e) {
    http_response_code(404);
    echo 'Error: ' . $e->getMessage();
}
