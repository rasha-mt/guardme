<?php

use Faker\Generator as Faker;


$factory->define(\Modules\Users\Models\User::class, function (Faker $faker) {
    return [
        'password' => bcrypt('12345'),
        'registered_date' => date('Y-m-d'),
        'username' => str_slug('dee','.'),
        'email' => $faker->safeEmail,
        'api_token' => str_random(60),
        'remember_token' => str_random(10),
    ];
});