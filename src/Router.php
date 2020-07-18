<?php
namespace Source\Framework;

class Router
{
    private array $routes = [];

    public function __construct()
    {
    }

    public function add(string $pattern, $callback)
    {
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        $this->routes[$pattern] = $callback;
    }

    public function run()
    {
        $url = $_SERVER['REQUEST_URI'] ?? '/';

        foreach ($this->routes as $route => $action) {

            if (preg_match($route, $url, $params)) {
                echo '<pre> '; var_dump($params); echo '</pre>';
                return $action($params);
            }
        }
        return 'Not found page';
    }
}