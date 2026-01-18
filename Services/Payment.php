<?php

namespace Services;

interface Payment
{
    public function createOrder();
    public function getStatus();
}