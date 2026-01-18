<?php

namespace ExternalServices;

interface Cdek
{
    public function createOrder();
    public function getOrder();
    public function getTariffList();
}