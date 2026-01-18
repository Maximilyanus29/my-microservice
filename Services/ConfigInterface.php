<?php

namespace Services;

interface ConfigInterface
{
    public function get($key, $default = null);
}