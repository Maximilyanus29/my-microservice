<?php declare(strict_types=1);

//Я вижу этот класс главным, это и есть приложение, которое содержит все нужные нам сервисы, то есть бд, логгер и т.д. По этому от класса App можно отказатся, зачем он нам есть есть сервисный контейнер?
use Services\Logger;
use Services\Cache;
use Services\DB;
use Services\Config;

class ServiceContainerFactory
{
    public static function make(): ServiceContainer
    {
        $logger = new Logger();
        $cache = new Cache();
        $db = new DB();
        $config = new Config();

        ServiceContainer::set(Logger::class, $logger);
        ServiceContainer::set(Logger::class, $cache);
        ServiceContainer::set(Logger::class, $db);
        ServiceContainer::set(Logger::class, $config);
    }
}