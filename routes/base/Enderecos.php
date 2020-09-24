$router->group(["prefix" => "Enderecos"], function () use ($router) {

            $router->get("/{id}",           "EnderecosController@show");
            $router->get("/" ,              "EnderecosController@showAll");
            $router->post("/",              "EnderecosController@create");
            $router->put("/",               "EnderecosController@update");
            $router->delete("/{id}",        "EnderecosController@update");
        
        });