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
namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

$factory->define(App\Models\Exam::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->userName,
        'duration' => $faker->numberBetween(1,12),
        'publish' => $faker->numberBetween(0,1),
    ];
});
