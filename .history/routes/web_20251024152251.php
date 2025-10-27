<?php
/** @var Core\Router $router */

$router->get('/', 'HomeController@index');
$router->get('/hello/{name}', 'HomeController@hello');
$router->post('/submit', ['HomeController', 'store']);

// Closure example
$router->get('/ping', function () { return 'pong'; });


