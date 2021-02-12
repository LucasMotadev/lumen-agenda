<?php

use App\Utils\Url;

if (isset($_SERVER['REQUEST_URI'])) {
    $url = new Url($_SERVER['REQUEST_URI']);
    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
    if ($url->baseUrl) {
        $router->group(['prefix' => $url->baseUrl], function () use ($router): void {

            $url = new Url($_SERVER['REQUEST_URI']);
            $url->setResourceUrl();

            $fileName = __DIR__ . $url->getRouteFileName();
            if (file_exists($fileName)) {
                require $fileName;
            };
        });
    }
}
