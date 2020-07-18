<?php
require __DIR__ . '/vendor/autoload.php';

$router = new \Source\Framework\Router;

$router->add('/', function () {
    return 'home';
});

$router->add('/projects', function () {
    return 'projects';
});

$router->add('/projects/(\d+)', function () {
    return 'projects';
});

echo $router->run();