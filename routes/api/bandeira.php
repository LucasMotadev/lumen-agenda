<?php

/*
|--------------------------------------------------------------------------
| Gerado altomaticamente  by Lucas Mota
|--------------------------------------------------------------------------
|
*/

$router->group(['prefix' => 'bandeira'], function () use ($router) {
    
    $router->get('/',       ['uses'=> 'Company\BandeiraController@index']);
    $router->post('/',      ['uses'=> 'Company\BandeiraController@store']);
    $router->put('/{id}',   ['uses'=> 'Company\BandeiraController@update']);
    $router->get('/{id}',   ['uses'=> 'Company\BandeiraController@show']);
    $router->delete('/{id}',['uses'=> 'Company\BandeiraController@destroy']);
    
});
