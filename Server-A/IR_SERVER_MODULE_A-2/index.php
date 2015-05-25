<?php
/**
 * WorldSkills 2015
 *
 * Created by Mohamad Mohebifar.
 * Country: Iran
 */

spl_autoload_extensions('.php');
spl_autoload_register();

use Utilities\AppKernel;
use Utilities\Router;

$baseUrl = dirname($_SERVER['SCRIPT_NAME']);
define('BASE_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . $baseUrl);

$requestUri = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
$uri = preg_replace('#' . $baseUrl . '#', '', $requestUri, 1);
$uri = '/' . trim($uri, '/');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$kernel = new AppKernel();
$router = new Router($kernel);
$router->import();
$router->route($uri);