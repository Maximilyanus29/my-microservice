<?php

namespace Services\Interfaces;

interface Shipping
{
    public function createOrder();
    public function getOrder();
    public function getTariffList();
}