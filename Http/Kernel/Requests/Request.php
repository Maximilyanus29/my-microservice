<?php declare(strict_types=1);

namespace Http\Kernel\Requests;


use Http\Kernel\Enums\RequestMethods;

class Request implements \Http\Kernel\Interfaces\Request
{
    public array $urlParams;
    private string $body;
    private array $queryParams;
    private string $requestUri;
    private RequestMethods $method;
    private array $postParams;

    public function __construct(RequestMethods $method, string $requestUri, string $queryString )
    {
        $this->method = $method;
        $this->requestUri = $requestUri;
        $this->queryParams = $_GET;
        $this->postParams = $_POST;
        $this->body = file_get_contents('php://input');
    }

    public function getHeader(string $string): ?string
    {
        return $this->headers[$string] ?? null;
    }

    public function getUrlParams(): array
    {
        return $this->urlParams;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getUri(): string
    {
        return $this->path;
    }

    public function getMethod(): RequestMethods
    {
        return $this->method;
    }
}