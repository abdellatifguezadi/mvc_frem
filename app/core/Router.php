<?php
namespace App\Core;

class Router
{
    private static $routes = [];
    
    public static function add($method, $route, $handler)
    {
        $pattern = $route;
        $pattern = preg_replace('/\//', '\\/', $pattern);
        $pattern = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $pattern);
        $pattern = '/^' . $pattern . '$/i';

        self::$routes[] = [
            'method' => $method,
            'route' => $route,
            'pattern' => $pattern,
            'handler' => $handler
        ];
    }

    public static function dispatch($url)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = trim($url, '/');
        
        foreach (self::$routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $url, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                [$controller, $action] = $route['handler'];
                $controller = new $controller();
                return call_user_func_array([$controller, $action], $params);
            }
        }
        
        throw new \Exception("No route matched for URL: $url");
    }
}
