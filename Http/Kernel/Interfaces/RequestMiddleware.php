<?php

namespace Http\Kernel\Interfaces;


interface RequestMiddleware
{
    public function handle(\Http\Kernel\Interfaces\Request $request);
}