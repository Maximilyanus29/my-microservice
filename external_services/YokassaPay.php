<?php

namespace ExternalServices;

interface YokassaPay
{
    public function createOrder();
    public function getStatus();
}