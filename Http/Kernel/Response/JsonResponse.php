<?php declare(strict_types=1);

namespace Http\Core;
use Http\Core\Interfaces\Response;

class JsonResponse implements Response
{
    private array $data;
    private int $statusCode;
    protected array $headers = [
        "Content-Type" => "application/json",
    ];

    public function __construct($data = [], $status = 200, array $headers = [], $error = false)
    {
        $this->statusCode = $status;
        $this->headers = array_merge($this->headers, $headers);
        $this->data = [
            'error' => $error,
            'data' => $data,
            'meta' => [],
        ];
    }

    public function send()
    {
        foreach ($this->headers as $key => $header) {
            header("$key: $header");
        }

        http_response_code($this->statusCode);

        return json_encode($this->data, JSON_THROW_ON_ERROR);
    }
}