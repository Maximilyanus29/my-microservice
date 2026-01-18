<?php

class ReplaceSecureDataResponse implements ResponseMiddleware
{

    public function handle(Response $response)
    {
        $body = $response->getBody();
        $response->setBody(str_replace("secure", "******", $body));
    }
}