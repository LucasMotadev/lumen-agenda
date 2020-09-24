$router->group(["prefix" => "NewView"], function () use ($router) {

            $router->get("/{id}",           "NewViewController@show");
            $router->get("/" ,              "NewViewController@showAll");
            $router->post("/",              "NewViewController@create");
            $router->put("/",               "NewViewController@update");
            $router->delete("/{id}",        "NewViewController@update");
        
        });