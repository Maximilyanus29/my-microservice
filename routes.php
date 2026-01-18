<?php
/**@var $router Router*/


//TODO над роутами надо бы ещё поработать, будут ли у нас контроллеры или презентаторы. По сути контроллер и делает работу презентатора, он получает данные из action и передаёт во view или отдаёт сразу в ответ или в resoure преобразователь.
//Но точно понадобится колбек. Для удобства, что бы быстренько что-то отрисовать, простую страницу.
$router->add('get', '/about' ['controller' => PageController::class, 'action' => 'about']);
$router->add('get', '/about' ['action' => About::class]);
//$router->add('post', ['controller' => 'Home', 'action' => 'index']);
//$router->add('delete', ['controller' => 'Home', 'action' => 'index']);
//$router->add('patch', ['controller' => 'Home', 'action' => 'index']);
//$router->add('options', ['controller' => 'Home', 'action' => 'index']);