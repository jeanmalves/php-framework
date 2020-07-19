<?php

$router->add('GET', '/', function () use ($container) {
    $pdo = $container['db'];
    return 'home';
});

$router->add('GET', '/projects', function () {
    return 'projects';
});

$router->add('GET','/projects/(\d+)', function () {
    return 'project';
});