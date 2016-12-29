<?php
/**
 * This file contains only the class {@see unknown}
 * @author Sören Parton
 * @since 2016-12-22
 */


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Board::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->word,
    ];
});

$factory->define(App\CardList::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->word,
        'board_id' => $faker->numberBetween(1,2),
        'weight' => $faker->numberBetween(1,10)
    ];
});

$factory->define(App\Card::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence,
        'card_list_id' => $faker->numberBetween(1,7),
        'weight' => $faker->numberBetween(1,10)
    ];
});
