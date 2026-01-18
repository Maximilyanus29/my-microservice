<?php declare(strict_types=1);

/*Если потребуется можем создать для html, pdf и т.д.*/
class JsonResponse extends Response
{
    protected array $headers = [
        "Content-Type" => "application/json",
    ];
    public function send()
    {
        $this->body = json_encode($this->body);
        return parent::send();
    }
}