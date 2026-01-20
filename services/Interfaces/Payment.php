<?php

namespace Services\Interfaces;

interface Payment
{
    public function createOrder();
    public function getStatus();
}