<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'api_token' => str_random(20),
    ];
});

$factory->define(App\Lists::class, function (Faker $faker) {

    return [
        'user_id' => function (){
          return factory(App\User::class)->create()->id;
        },
        'title' => $faker->sentence,
    ];
});

$factory->define(App\Item::class, function (Faker $faker) {

    return [
        'list_id' => function (){
          return factory(App\Lists::class)->create()->id;
        },
        'body' => $faker->sentence,
    ];
});
