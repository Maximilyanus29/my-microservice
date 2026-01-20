<?php declare(strict_types=1);


namespace Http\Kernel;

use Http\Kernel\Exceptions\InvalidHandleException;
use Http\Kernel\Interfaces\Request;
use Http\Kernel\Interfaces\Response;

class Route
{
    private $method;
    private $pattern;
    private $handler;
    private $params;
    private Request $request;

    public function __construct($method, $pattern, $handler)
    {
        $this->method = $method;
        $this->pattern = $pattern;
        $this->handler = $handler;
    }

    /**
     * @return mixed
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function handle(): Response
    {
        $controller = new $this->handler[0];
        $controller->setRoute($this->request);

        if (count($this->handler) === 2) {
            return $controller->$this->handler[1]();
        } elseif (count($this->handler) === 1) {
            return $controller->$this->request->getMethod();
        }
        throw new InvalidHandleException();
    }

    public function match(Request $request): bool
    {
        if ($request->getMethod() !== $this->method) {
            return false;
        }

        $patternSegments = explode('/', $this->pattern);
        foreach (explode('/', $request->path) as $key => $segment) {
            if (!isset($patternSegments[$key])) {
                return false;
            }
            $paramName = trim($patternSegments[$key], '{}');
            $this->params[$paramName] = $segment;
        }
        $this->request = $request;
        return true;
    }

    /**
     * @param string $string
     * @return string|null
     */
    public function getParams(string $string = ''): ?string
    {
        return $this->params[$string] ?? null;
    }

    public function getMethod()
    {
        return $this->method;
    }
}