<?php

namespace Http\Kernel\Middlewares;

class CustomMiddleware
{

    public function handle()
    {
        error_log("CustomMiddleware::handle()");
    }
}