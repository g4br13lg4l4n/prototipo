<?php
use App\User;
use App\Article;
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

$factory->define(User::class, function (Faker $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'status' => $verificado = $faker->randomElement(['Activo', 'Inicativo']),
    ];
});

$factory->define(Article::class, function(Faker $faker){
    return [
        'internalCode' => $faker->numberBetween(5000, 100000),
        'name' => $faker->word,
        'shortName' => $faker->name,
        'description' => $faker->paragraph(1),
        'stock' => $faker->numberBetween(1, 10),
        'purchasePrice' => 200,
        'salePrice' => 500,
        'offerPrice' => 400,
        'status' => $faker->randomElement(['Visible', 'Borrador', 'Oculto'])
    ];
});
