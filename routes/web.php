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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/test','TestController@index');
$router->group(['prefix' => 'api/v1'], function() use ($router)
{
    $router->post('login','SystemAccountController@login');


    $router->post('user/add','UsersController@createUser');
    $router->put('user/edit','UsersController@updateUser');
    $router->delete('user/remove','UsersController@deleteUser');
    $router->delete('user/batchremove','UsersController@batchDeleteUser');
    $router->get('user/listpage','UsersController@index');
    $router->get('user/list','UsersController@listUser');

    $router->get('artical/list','ArticalController@listArtical');


    //商品信息表
    $router->get('goods/list','GoodsController@index');
});
