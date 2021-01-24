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

    $router->group(['prefix' => '{id}'], function () use ($router){
        $router->get('fisicas', ['uses' => 'Pessoa\PessaFisicaController@index']);
    });

    $router->get('/',       'Pessoas\PessoaController@index');
    $router->post('/',      'Pessoas\PessoaController@store');
    $router->put('/{id}',   'Pessoas\PessoaController@update');
    $router->get('/{id}',   'Pessoas\PessoaController@show');
    $router->delete('/{id}','Pessoas\PessoaController@destroy');


});
