<?php
require __DIR__ . '/vendor/autoload.php';

$router = new \Source\Framework\Router;

require  __DIR__ . '/config/containers.php';
require __DIR__ . '/config/routes.php';

try {
    $result = $router->run();

    $response = new Source\Framework\Response;
    $response($result['action'], $result['params']);

} catch (\Source\Framework\Exceptions\HttpException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}