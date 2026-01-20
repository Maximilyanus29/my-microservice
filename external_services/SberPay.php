<?php

namespace ExternalServices;

interface SberPay
{
    public function createOrder();
    public function getStatus();
}