<?php

/*
|--------------------------------------------------------------------------
| Gerado altomaticamente  by Lucas Mota
|--------------------------------------------------------------------------
|
*/

$router->group(['prefix' => 'empresas'], function () use ($router) {

    $router->get('/',       ['uses'=> 'Company\EmpresasController@index']);
    $router->post('/',      ['uses'=> 'Company\EmpresasController@store']);
    $router->put('/{id}',   ['uses'=> 'Company\EmpresasController@update']);
    $router->get('/{id}',   ['uses'=> 'Company\EmpresasController@show']);
    $router->delete('/{id}',['uses'=> 'Company\EmpresasController@destroy']);
    
});
