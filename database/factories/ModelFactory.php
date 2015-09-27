<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Container::class, function ($faker) {
    return [
        'name' => 'test'. md5(time()),
    ];
});

$factory->define(App\Coordinate::class, function ($faker) {
    return [
    	'container_id'	=> factory(App\Container::class)->create()->id,
    	'longitude'	=> 42.65728149414061,
    	'latitude'	=> 23.314630126953126
    ];
});
