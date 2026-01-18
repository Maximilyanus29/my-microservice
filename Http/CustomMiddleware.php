<?php

namespace Http;
class CustomMiddleware
{

    public function handle()
    {
        error_log("CustomMiddleware::handle()");
    }
}