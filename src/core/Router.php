<?php

namespace core;

use Exception;

class Router
{
    public array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function load($file)
    {
        $router = new static();

        require $file;

        return $router;
    }

    /**
     * @param string $uri
     * @param array $action
     * @return void
     */
    public function get(string $uri, string $action): void
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post(string $uri, string $action): void
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );
        }

        throw new Exception('No route found');
    }

    public function callAction($controller, $action)
    {
        $params = Request::params();
        $controller = "\\app\\controllers\\{$controller}";
        $controller = new $controller();

        if (!method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }
        if (empty($params)) {
            return $controller->$action();
        }

        return $controller->$action($params);
    }
}
