$router->group(["prefix" => "Telefones"], function () use ($router) {

            $router->get("/{id}",           "TelefonesController@show");
            $router->get("/" ,              "TelefonesController@showAll");
            $router->post("/",              "TelefonesController@create");
            $router->put("/",               "TelefonesController@update");
            $router->delete("/{id}",        "TelefonesController@update");
        
        });