<?php

namespace Http\Kernel\Interfaces;


interface ResponseMiddleware
{
    public function handle(Response $response);
}