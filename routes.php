<?php
/**@var $router Router*/

use app\Controller\EventController;
use Http\Core\Router;

$router->add('get', '/event', [EventController::class, 'get']);
$router->add('get', '/event/{id}', [EventController::class, 'get']);
$router->add('post', '/event', [EventController::class, 'post']);
$router->add('patch', '/event/{id}', [EventController::class, 'update']);
$router->add('put', '/event/{id}', [EventController::class, 'update']);
$router->add('delete', '/event/{id}', [EventController::class, 'delete']);
