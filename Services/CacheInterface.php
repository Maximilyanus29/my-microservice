<?php

namespace Services;

interface CacheInterface
{
    public function has($key);
    public function get($key);
    public function set($key, $value);
}