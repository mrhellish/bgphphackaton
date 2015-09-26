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

$app->get('/', 'AppController@index');

$app->group(['prefix' => 'api'], function ($app) {
    $app->get('/', function ()  {
    });

    $app->get('user/profile', function () {
    });
});