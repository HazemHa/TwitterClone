<?php
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
/*
|
--------------------------------------------------------------------------
| Model Factories
|
-------------------------------------------------------------------------
|
| This directory should contain each of the model
factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your
application's database.
|
*/

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'bio' => $faker->name,
        'designation' => $faker->realText($faker->numberBetween(10,20)),
        'company' => $faker->name,
        'city' => $faker->city,
        'country' => $faker->country,
        'dob' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'user_id' => function () {
            return App\User::inRandomOrder()->first()->id;
        }
    ];
});
