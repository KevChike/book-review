<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Book::class, function (Faker $faker) {
    return [
        'isbn' => $faker->isbn13,
        'title' => $faker->sentence,
        'author' => $faker->name,
        'edition' => $faker->numberBetween(1, 7),
        'summary' => $faker->paragraph(5),
        'publication_year' => $faker->year,
    ];
});
