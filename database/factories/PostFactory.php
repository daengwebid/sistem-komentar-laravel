<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->paragraph($nbSentences = 3, $variableNbSentences = true);
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'content' => $faker->text($maxNbChars = 200)
    ];
});
