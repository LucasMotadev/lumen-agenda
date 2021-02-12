<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->group(['prefix' => 'pessoas'], function () use ($router) {
    $router->get('/',       'People\PessoaController@index');
    $router->post('/',      'People\PessoaController@store');
    $router->put('/{id}',   'People\PessoaController@update');
    $router->get('/{id}',   'People\PessoaController@show');
    $router->delete('/{id}','People\PessoaController@destroy');
});
