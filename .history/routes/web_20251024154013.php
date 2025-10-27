<?php
/** @var Core\Router $router */

$router->get('/', ['home', 'index']);
$router->get('/hello/{name}', ['home', 'hello']);
$router->post('/submit', ['home', 'store']);

// Closure example
$router->get('/ping', function () { return 'pong'; });


