<?php
require __DIR__ . '/vendor/autoload.php';

$router = new \Source\Framework\Router;

$router->add('GET', '/', function () {
    return 'home';
});

$router->add('GET', '/projects', function () {
    return 'projects';
});

$router->add('GET','/projects/(\d+)', function () {
    return 'project';
});

try {
    echo $router->run();
} catch (\Source\Framework\Exceptions\HttpException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}