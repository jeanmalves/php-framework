<?php
namespace Source\Framework;

use Pimple\Container;
use Source\Framework\Router;
use Source\Framework\Response;
use Source\Framework\Exceptions\HttpException;

class App
{
    private Container $container;
    private $middlewares = [
        'before' => [],
        'after' => []
    ];

    public function __construct(Container $container = null)
    {
        $this->container = $container;

        if ($this->container === null) {
            $this->container = new Container();
        }
    }

    public function middleware($on, $callback)
    {
        $this->middlewares[$on][] = $callback;
    }

    public function getRouter()
    {
        if (!$this->container->offsetExists('router')) {
            $this->container['router'] = function () {
                return new Router;
            };
        }

        return $this->container['router'];
    }

    public function getResponder()
    {
        if (!$this->container->offsetExists('responder')) {
            $this->container['responder'] = function () {
                return new Response;
            };
        }

        return $this->container['responder'];
    }

    public function getHttpErrorHandler()
    {
        if (!$this->container->offsetExists('httpErrorHandler')) {
            $this->container['httpErrorHandler'] = function ($c) {
                header('content-type: application/json');
                return json_encode([
                    'code' => $c['exception']->getCode() ,
                    'error' => $c['exception']->getMessage()
                ]);
            };
        }

        return $this->container['httpErrorHandler'];
    }

    public function run()
    {
        try {
            $response = $this->getResponder();

            $result = $this->getRouter()->run();
            $params = [
                'container' => $this->container,
                'params' => $result['params']
            ];

            foreach ($this->middlewares['before'] as $middleware) {
                $middleware($this->container);
            }

            $response($result['action'], $params);

            foreach ($this->middlewares['after'] as $middleware) {
                $middleware($this->container);
            }

        } catch (HttpException $e) {
            $this->container['exception'] = $e;
            echo $this->getHttpErrorHandler();
        }
    }
}