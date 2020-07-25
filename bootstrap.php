<?php
require __DIR__ . '/vendor/autoload.php';

$router = new \Source\Framework\Router;

require  __DIR__ . '/config/containers.php';
require  __DIR__ . '/config/events.php';
require __DIR__ . '/config/routes.php';

try {
    $response = new Source\Framework\Response;

    $result = $router->run();
    $params = [
        'container' => $container,
        'params' => $result['params']
    ];

    $response($result['action'], $params);

} catch (\Source\Framework\Exceptions\HttpException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}