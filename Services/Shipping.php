<?php

namespace Services;

interface Shipping
{
    public function createOrder();
    public function getOrder();
    public function getTariffList();
}