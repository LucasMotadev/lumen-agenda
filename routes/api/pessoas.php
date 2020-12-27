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
$router->group(['prefix' => 'pessoas', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/',       'PessoaController@index');
    $router->post('/',      'PessoaController@store');
    $router->put('/{id}',   'PessoaController@update');
    $router->get('/{id}',   'PessoaController@show');
    $router->delete('/{id}','PessoaController@destroy');



});
