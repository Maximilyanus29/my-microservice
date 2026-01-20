<?php

namespace Services\Interfaces;

interface Config
{
    public function get($key, $default = null);
}