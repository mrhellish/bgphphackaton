<?php

$app->get('/', 'AppController@index');

$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function ($app) {

	$app->get('containers', 'ContainersController@index');
	$app->get('containers/{id}', 'ContainersController@get');
	$app->post('containers', 'ContainersController@create');
	$app->put('containers/{id}', 'ContainersController@update');
	$app->delete('containers/{id}', 'ContainersController@destroy');

	$app->get('coordinates', 'CoordinatesController@index');
	$app->get('coordinates/{container_id}', 'CoordinatesController@getByContainer');
	$app->post('coordinates/{container_id}', 'CoordinatesController@create');
	$app->put('coordinates/{id}', 'CoordinatesController@update');
	$app->delete('coordinates/{id}', 'CoordinatesController@destroy');

});