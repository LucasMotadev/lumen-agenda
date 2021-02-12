<?php

/*
|--------------------------------------------------------------------------
| Gerado altomaticamente  by Lucas Mota
|--------------------------------------------------------------------------
|
*/

$router->group(['prefix' => 'pessoas-fisicas'], function () use ($router) {

    $router->get('/',       ['uses'=> 'People\PessoasfisicasController@index']);
    $router->post('/',      ['uses'=> 'People\PessoasfisicasController@store']);
    $router->put('/{id}',   ['uses'=> 'People\PessoasfisicasController@update']);
    $router->get('/{id}',   ['uses'=> 'People\PessoasfisicasController@show']);
    $router->delete('/{id}',['uses'=> 'People\PessoasfisicasController@destroy']);
    
});
