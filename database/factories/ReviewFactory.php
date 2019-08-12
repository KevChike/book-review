<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Review::class, function (Faker $faker) {
    return [
        'book_id' => factory(\App\Models\Book::class)->create()->id,
        'user_id' => factory(\App\User::class)->create()->id,
        'rating' => $faker->numberBetween(1, 5),
        'content' => $faker->sentence(),
    ];
});
