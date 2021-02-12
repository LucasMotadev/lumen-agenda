<?php

/*
|--------------------------------------------------------------------------
| Gerado altomaticamente  by Lucas Mota
|--------------------------------------------------------------------------
|
*/

$router->group(['prefix' => 'pessoas-juridicas'], function () use ($router) {

    $router->get('/',       ['uses'=> 'People\PessoasjuridicasController@index']);
    $router->post('/',      ['uses'=> 'People\PessoasjuridicasController@store']);
    $router->put('/{id}',   ['uses'=> 'People\PessoasjuridicasController@update']);
    $router->get('/{id}',   ['uses'=> 'People\PessoasjuridicasController@show']);
    $router->delete('/{id}',['uses'=> 'People\PessoasjuridicasController@destroy']);
    
});
