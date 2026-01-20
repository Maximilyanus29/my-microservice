<?php

namespace Services\Interfaces;

interface Cache
{
    public function has($key);
    public function get($key);
    public function set($key, $value);
}