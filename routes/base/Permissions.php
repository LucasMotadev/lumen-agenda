$router->group(["prefix" => "Permissions"], function () use ($router) {

            $router->get("/{id}",           "PermissionsController@show");
            $router->get("/" ,              "PermissionsController@showAll");
            $router->post("/",              "PermissionsController@create");
            $router->put("/",               "PermissionsController@update");
            $router->delete("/{id}",        "PermissionsController@update");
        
        });