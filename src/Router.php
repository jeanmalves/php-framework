<?php
namespace Source\Framework;

use Source\Framework\Exceptions\HttpException;

class Router
{
    private array $routes = [];

    public function add(string $httpMethod, string $pattern, $callback)
    {
        $httpMethod = strtolower($httpMethod);
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        $this->routes[$httpMethod][$pattern] = $callback;
    }

    public function getCurrentUrl()
    {
        $url = $url = $_SERVER['REQUEST_URI'] ?? '/';
        if (strlen($url) > 1) {
            $url = rtrim($url, '/');
        }
        return $url;
    }

    public function run()
    {
        $url = $this->getCurrentUrl();
        $httpMethod = strtolower($_SERVER['REQUEST_METHOD']);

        if (empty($this->routes[$httpMethod])) {
            throw new HttpException('Not found page', 404);
        }

        foreach ($this->routes[$httpMethod] as $route => $action) {
            if (preg_match($route, $url, $params)) {
                return compact('action', 'params');
            }
        }
        throw new HttpException('Not found page', 404);
    }
}