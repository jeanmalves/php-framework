<?php

$router->add('GET', '/', function () use ($container) {
    return 'home';
});

$router->add('GET', '/projects', function () {
    return 'projects';
});

$router->add('GET','/users/(\d+)', function ($params) use ($container) {
    return (new \App\Controllers\UsersController($container))->show($params[1]);
});