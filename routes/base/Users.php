$router->group(["prefix" => "Users"], function () use ($router) {

            $router->get("/{id}",           "UsersController@show");
            $router->get("/" ,              "UsersController@showAll");
            $router->post("/",              "UsersController@create");
            $router->put("/",               "UsersController@update");
            $router->delete("/{id}",        "UsersController@update");
        
        });