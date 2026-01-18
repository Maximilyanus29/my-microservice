<?php declare(strict_types=1);

//Я вижу этот класс главным, это и есть приложение, которое содержит все нужные нам сервисы, то есть бд, логгер и т.д. По этому от класса App можно отказатся, зачем он нам есть есть сервисный контейнер?
//Может он должен называться ServiceProvider?
class ServiceContainer
{
    private static $services = [];

    //Что бы не делать синглтон, сделал статические методы, что бы можно было вызвать откуда хочешь.
    public static function get(string $key)
    {
        return self::$services[$key];
    }

    public static function set(string $key, $value)
    {
        self::$services[$key] = $value;
    }
}