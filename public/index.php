<?php

//Не стал выносить в класс, так как 3 строки всего занимает, не считаю что оно того стоит. Да может изменится, но тот кто будет изменять, вынесет в отдельный класс, не вижу проблемы.

use Http\Kernel\Router;
use Http\Kernel\Middlewares\AuthMiddleware;
use Http\Kernel\Requests\Request;

$BASEDIR = dirname(__DIR__);

spl_autoload_register(function ($class) {
    global $BASEDIR;
    require_once $BASEDIR . "\\" . str_replace('/', '\\', $class) . '.php';
});

$requstMethod = \Http\Kernel\Enums\RequestMethods::from( $_SERVER['REQUEST_METHOD']);

$request = new Request(, $_SERVER['REQUEST_URI'], $_SERVER['QUERY_STRING'] ?? '');

//Вообще промежуточно ПО можно вставлять куда угодно, интерфейсы разные должны быть, так как зависимость разная, auth мидлвар скорее всего нужен
$middleware = new AuthMiddleware();
$middleware->handle($request);

$router = new Router($request);

require_once "$BASEDIR/routes.php";

try {
    $route = $router->dispatch();
    var_dump($route);die;
    //TODO если роут не нашёлся надо типа предложить подсказку метод options использовать? вызвать метод options у какого либо ресурса, кажется я видел в лучших практиках, что надо так делать.

    ServiceContainerFactory::make();

    $response = $route->handle();

//    Если вдруг нужен мидлвар, думаю плохая практика изменять уже сформированный ответ
//    $middleware = new ReplaceSecureDataResponse();
//    $middleware->handle($response);

    echo $response->send();
}catch (\Exception $e){
    // в exceptionaх должен быть код ошибки и message
    $contentType = $request->getHeader('Content-Type');

    switch ($contentType) {
        case MimeTypes::Json:
            $response = new JsonResponse([$e->getMessage()], $e->getCode(), [], true);
            break;
        case MimeTypes::Html:
            $response = new HtmlResponse($e->getMessage(), $e->getCode());
        default:
            $response = new JsonResponse([$e->getMessage()], $e->getCode(), [], true);
    }
    $response->send();
}



