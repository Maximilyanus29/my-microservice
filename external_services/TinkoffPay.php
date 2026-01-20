<?php

namespace ExternalServices;

interface TinkoffPay
{
    public function createOrder();
    public function getStatus();
}