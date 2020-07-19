<?php
use App\Models\User;

$router->add('GET', '/', function () use ($container) {
    return 'home';
});

$router->add('GET', '/projects', function () {
    return 'projects';
});

$router->add('GET','/users/(\d+)', function ($params) use ($container) {
    $user = new User($container);
    $data = $user->get($params[1]);
    var_dump($data);
    return 'project';
});