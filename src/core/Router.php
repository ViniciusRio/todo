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

    public function direct($uri, $requestType)
    {
        echo "<pre>";
            var_dump(
                trim(
                    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
                    '/'
                )
            );
        echo "</pre>";

        exit;

        if (array_key_exists($uri, $this->routes[$requestType])) {
            
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );
        }

        throw new Exception('No route found');
    }

    public function callAction($controller, $action)
    {
        $controller = "\\app\\controllers\\{$controller}";
        $controller = new $controller();

        if (!method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }

        return $controller->$action();

    }

}