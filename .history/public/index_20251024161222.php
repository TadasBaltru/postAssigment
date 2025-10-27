<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Core\Router;

$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
if ($basePath === '/' || $basePath === '.') {
	$basePath = '';
}
if (!defined('BASE_PATH')) {
	define('BASE_PATH', $basePath);
}

$router = new Router();

// Load route definitions
require __DIR__ . '/../routes/web.php';

// Dispatch the request
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);


