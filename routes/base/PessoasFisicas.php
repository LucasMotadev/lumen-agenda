$router->group(["prefix" => "PessoasFisicas"], function () use ($router) {

            $router->get("/{id}",           "PessoasFisicasController@show");
            $router->get("/" ,              "PessoasFisicasController@showAll");
            $router->post("/",              "PessoasFisicasController@create");
            $router->put("/",               "PessoasFisicasController@update");
            $router->delete("/{id}",        "PessoasFisicasController@update");
        
        });