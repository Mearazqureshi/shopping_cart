<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'quantity' => random_int(10,99),
        'price' => random_int(00001,99999),
        'image' => '16686957102763923.jpg',
        'status' => 'active',
    ];
});
