<?php

$router->add('GET', '/', function () use ($container) {
    return 'home';
});

$router->add('GET', '/projects', function () {
    return 'projects';
});

$router->add('GET','/users/(\d+)', '\App\Controllers\UsersController::show');