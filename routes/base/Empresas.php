$router->group(["prefix" => "Empresas"], function () use ($router) {

            $router->get("/{id}",           "EmpresasController@show");
            $router->get("/" ,              "EmpresasController@showAll");
            $router->post("/",              "EmpresasController@create");
            $router->put("/",               "EmpresasController@update");
            $router->delete("/{id}",        "EmpresasController@update");
        
        });