<?php
$router->get('/', ['home', 'index']);
$router->post('/posts/{id:\\d+}/update', ['posts', 'update']);
$router->post('/posts/store', ['posts', 'store']);
$router->get('/posts/{id:\\d+}/view', ['posts', 'view']);
$router->get('/posts/create', ['posts', 'create']);
$router->post('/posts/{id:\\d+}/delete', ['posts', 'delete']);
$router->get('/posts/{id:\\d+}/edit', ['posts', 'edit']);
$router->get('/persons', ['person', 'index']);
$router->get('/groups', ['group', 'index']);

$router->get('/migrate', ['db', 'migrate']);


