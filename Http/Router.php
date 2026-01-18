<?php declare(strict_types=1);

use Http\RouteNotFoundException;

class Router
{
    private Request $request;
    private $routes = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function add($method, $pattern, $handler)
    {
        $this->routes[] = new Route($method, $pattern, $handler);
    }

    public function dispatch(): Route
    {
        foreach ($this->routes as $route) {
            return $route;
        }
        throw new RouteNotFoundException();
    }
}