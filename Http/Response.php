<?php declare(strict_types=1);

abstract class Response
{
    protected string $body = '';
    protected mixed $data;
    protected array $headers = [] {
        get {
            return $this->headers;
        }
        set {
            $this->headers = $value;
        }
    }
    protected array $cookies = [] {
        get {
            return $this->cookies;
        }
        set {
            $this->cookies = $value;
        }
    }
    protected int $statusCode = 0 {
        get {
            return $this->statusCode;
        }
        set {
            $this->statusCode = $value;
        }
    }

    public function __construct(string $data, $statusCode, $headers = [], $cookies = [])
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->cookies = $cookies;
    }

    public function send()
    {
        foreach ($this->cookies as $cookie) {
            setcookie($cookie);
        }

        foreach ($this->headers as $key => $header) {
            header("$key: $header");
        }

        http_response_code($this->statusCode);

        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

}