$router->group(["prefix" => "CentroCustos"], function () use ($router) {

            $router->get("/{id}",           "CentroCustosController@show");
            $router->get("/" ,              "CentroCustosController@showAll");
            $router->post("/",              "CentroCustosController@create");
            $router->put("/",               "CentroCustosController@update");
            $router->delete("/{id}",        "CentroCustosController@update");
        
        });