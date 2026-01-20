<?php

namespace Services\Interfaces;

interface Logger
{
    public function debug($message);
    public function info($message);
    public function warning($message);
    public function critical($message);
    public function error($message);
}