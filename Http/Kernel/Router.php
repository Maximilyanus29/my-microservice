<?php declare(strict_types=1);

namespace Http\Kernel;


use Http\Kernel\Exceptions\RouteNotFoundException;
use Http\Kernel\Interfaces\Request;

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
            if ($this->match($this->request, $route)) {
                return $route;
            }
        }
        throw new RouteNotFoundException();
    }

    public function match(Request $request, Route $route): bool
    {
        if ($request->getMethod() !== $route->getMethod()) {
            return false;
        }

        $urlParams = [];
        $patternSegments = explode('/', $route->getPattern());
        foreach (explode('/', $request->getUri()) as $key => $segment) {
            if (!isset($patternSegments[$key])) {
                return false;
            }
            $paramName = trim($patternSegments[$key], '{}');
            $urlParams[$paramName] = $segment;
        }
        $this->request->urlParams = $urlParams;
        return true;
    }


}