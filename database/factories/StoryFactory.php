<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Story;
use App\User;
use Faker\Generator as Faker;

$factory->define(Story::class, function (Faker $faker) {
    // Create a list of random words comma separated to represent the genres in the story.
    $genres = new StdClass();
    $genres->genres = $faker->word . ',' . $faker->word;

    $participants = $faker->numberBetween(1,100);
    $skip_step = $faker->numberBetween(0, $participants - 1); // Skip steps must not be >= to the participants

    return [
        'owner_id'          => factory(User::class),
        'title'             => $faker->sentence(4),
        'description'       => $faker->paragraph(4),
        'genre'             => json_encode($genres),
        'max_participant'   => $participants,
        'chars_per_turn'    => $faker->numberBetween(50,5000),
        'skip_step'         => $skip_step,
        'visible_history'   => $faker->numberBetween(0,10000),
        'notes'             => $faker->paragraph(5),
        'public'            => false,
        'finished'          => false,
        'published'         => false,
        'deleted'           => false,
    ];
});
