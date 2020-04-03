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
$router->group(['prefix' => 'user'], function () use ($router) {
    $router->post('store',  'Users\\UserController@create');
    $router->post('reset',  'Users\\UserController@solicitResetPassword');
   
});
