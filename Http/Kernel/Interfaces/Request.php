<?php

namespace Http\Kernel\Interfaces;

use Http\Kernel\Enums\RequestMethods;

interface Request
{
    public function getBody():string;
    public function getQueryParams():array;
    public function getUrlParams():array;
    public function getUri():string;
    public function getMethod():RequestMethods;
}