<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Core\Router;

$router = new Router();

// Load route definitions
require __DIR__ . '/../routes/web.php';

// Dispatch the request
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);


