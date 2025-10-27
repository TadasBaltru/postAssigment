<?php

$router->get('/', ['home', 'index']);
$router->get('/hello/{name}', ['home', 'hello']);
$router->post('/submit', ['home', 'store']);

$router->get('/ping', function () { return 'pong'; });

$router->get('/migrate', ['db', 'migrate']);


