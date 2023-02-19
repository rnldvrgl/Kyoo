<?php

session_start();

// Declare a base path constant
const BASE_PATH = __DIR__ . '/../';

// Pull in the helper functions
require BASE_PATH . 'Core/functions.php';

// Autoload files
spl_autoload_register(function ($class) {
	$class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

	require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new \Core\Router();

// Require the router
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
