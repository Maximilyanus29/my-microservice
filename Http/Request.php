<?php declare(strict_types=1);

class Request
{
    /**
     * @var mixed
     */
    private $method;
    /**
     * @var mixed
     */
    private $path;

    public function __construct($method, $path)
    {
        $this->method = $method;
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    public function getHeader(string $string)
    {
        return $this->headers[$string] ?? 'application/json';//потому что микросервис это в первую очередь про api.
    }
}