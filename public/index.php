<?php

use Http\Core\JsonResponse;
use Http\Kernel\Enums\MimeTypes;
use Http\Kernel\Router;
use Http\Kernel\Middlewares\AuthMiddleware;
use Http\Kernel\Requests\Request;

$BASEDIR = dirname(__DIR__);

//Не стал выносить в класс, так как 4 строки всего занимает, не считаю что оно того стоит. Да может измениться, но тот кто будет изменять, вынесет в отдельный класс, не вижу проблемы.
spl_autoload_register(function ($class) {
    global $BASEDIR;
    require_once $BASEDIR . "\\" . str_replace('/', '\\', $class) . '.php';//через try/catch не отловить
});

try {
    $requstMethod = \Http\Kernel\Enums\RequestMethods::from( "AGgsa");//тоже ошибку не обработать почему то
} catch (\ValueError $e) {
    // Обрабатываем ошибку значения
    echo "Invalid value: " . $e->getMessage();die;
}


$request = new Request($requstMethod, $_SERVER['REQUEST_URI'], $_SERVER['QUERY_STRING'] ?? '');

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
    sendErrorResponse($request, $e);
}


/**
 * @throws JsonException
 */
function sendErrorResponse($request = null, $exception = null): void
{
    $contentType = $request->getHeader('Content-Type');

    switch ($contentType) {
        case MimeTypes::Json:
            $response = new JsonResponse([$exception->getMessage()], $exception->getCode(), [], true);
            break;
        default:
            $response = new JsonResponse([$exception->getMessage()], $exception->getCode(), [], true);
    }
    echo $response->send();
}
