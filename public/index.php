<?php

//Не стал выносить в класс, так как 3 строки всего занимает, не считаю что оно того стоит. Да может изменится, но тот кто будет изменять, вынесет в отдельный класс, не вижу проблемы.
spl_autoload_register(function ($class) {
    require_once $class . '.php';
});

$request = new Request( $_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

//Вообще промежуточно ПО можно вставлять куда угодно, интерфейсы разные должны быть, так как зависимость разная, auth мидлвар скорее всего нужен
$middleware = new AuthMiddleware();
$middleware->handle($request);

$router = new Router($request);

//можно вообще сюда подставить кастомный делающий что-то абстрактное, невозможно интерфейс подогнать к единой абстракции. А мне кажется мидлвару даже не нужен интерфейс
//Если вдруг нужен мидлвар
//$middleware = new CustomMiddleware();
//$middleware->handle();

require_once "routes.php";

try {
    $route = $router->dispatch();
    //TODO если роут не нашёлся надо типа предложить подсказку? вызвать метод options у какого либо ресурса, кажется я видел в лучших практиках, что надо так делать.

    ServiceContainerFactory::make();

    $response = $route->handle();

//    Если вдруг нужен мидлвар, думаю плохая практика изменять уже сформированный ответ
//    $middleware = new ReplaceSecureDataResponse();
//    $middleware->handle($response);

    $response->send();
}catch (\Exception $e){
    // в exceptionaх должен быть код ошибки и message
    $contentType = $request->getHeader('Content-Type');

    switch ($contentType) {
        case MimeTypes::Json:
            $response = new JsonResponse($e->getMessage(), $e->getCode());
            break;
        case MimeTypes::Html:
            $response = new HtmlResponse($e->getMessage(), $e->getCode());
        default:
            $response = new JsonResponse($e->getMessage(), $e->getCode());
    }
    $response->send();
}



