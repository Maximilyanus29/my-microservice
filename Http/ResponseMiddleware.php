<?php

interface ResponseMiddleware
{
    public function handle(Response $response);
}