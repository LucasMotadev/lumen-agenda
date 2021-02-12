<?php

/*
|--------------------------------------------------------------------------
| Gerado altomaticamente  by Lucas Mota
|--------------------------------------------------------------------------
|
*/

$router->group(['prefix' => 'tipos-pessoas'], function () use ($router) {
    $router->get('/',       ['uses'=> 'People\TipospessoasController@index']);
    $router->post('/',      ['uses'=> 'People\TipospessoasController@store']);
    $router->put('/{id}',   ['uses'=> 'People\TipospessoasController@update']);
    $router->get('/{id}',   ['uses'=> 'People\TipospessoasController@show']);
    $router->delete('/{id}',['uses'=> 'People\TipospessoasController@destroy']);    
});
