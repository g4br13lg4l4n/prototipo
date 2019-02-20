<?php
use App\User;
use App\Article;
use App\Category;
use App\Client;
use App\Sale;
use App\SaleDetail;
use App\Http\Controllers\CategoryController;
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

$factory->define(Category::class, function(Faker $faker ){
    $categoryController = new CategoryController();
    $genericCode = $categoryController->generationCode("");
    $level = 1;
    return [
        'genericCode' => $genericCode,
        'category' => "Categoria_".$genericCode,
        'shortName' =>"Cat_".$genericCode,
        'description' => str_random(30),
        'level' => $level
    ];
});

$factory->define(Client::class, function(Faker $faker ){
    return [
        'name' => $faker->name,
        'lastName' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt("secret"),
        'status' =>  $faker->randomElement(['Activo', 'Inactivo',])
    ];
});

$factory->define(Sale::class, function(Faker $faker ){
    return [
        'folio' => $faker->unique()->numberBetween(1000, 2000),
        'saleDate'=> $faker->dateTime($max = 'now') ,
      //  'payDate' =>,
      //  'cancellationDate' =>,
        'previousAmount' => 0,
        'tax' => 0,
        'amount' => 0,
        'saleStatus' =>  $faker->randomElement(['Pendiente', 'Pagado',]),
        'shippingStatus' =>  $faker->randomElement(['En Proceso', 'Entregado',]),
    ];
});



$factory->define(SaleDetail::Class, function(Faker $faker){
    return[
        'quantity' => $faker->numberBetween(1, 100),
        'amount'=> $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = NULL), 
        'article_id' => Article::inRandomOrder()->first()->id,
    ];
});