<?php

use App\User;
use App\Article;
use App\Category;
use App\ArticleCategory;
use App\Client;
use App\Sale;
use App\SaleDetail;
use App\Http\Controllers\CategoryController;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $cantidadUsuarios = 10;
        $cantidadArticulos = 10;
        $cantidadCategorias = 10;
        $cantidadClientes = 10;
        $cantidadVentas = 100;
        $cantidadVentasDetalles = 3;
        $categoryController = new CategoryController();

        factory(User::class, $cantidadUsuarios)->create();
        factory(User::class)->create(
            [
                'name' => 'Administrador', 
                'email' => 'admin@dopsa.com', 
                'status' => 'Activo',
                'password' => bcrypt('secret'),
            ]
        );
        for ($i = 1; $i <= $cantidadCategorias; $i++) {
           $category = factory(Category::class)->create();
           factory(Category::class)->create(
                [
                    'genericCode' => $categoryController->generationCode($category->genericCode), 
                    'category' => "Categoria_".$i.".1",
                    'shortName' =>"Cat_".$i.".1",
                    'description' => str_random(30),
                    'level' => 2
                ]
           );
        }  
        
        factory(Article::class,$cantidadArticulos)->create()->each(function($article){
            $article->categories()->attach([
                Category::inRandomOrder()->first()->id
            ]);
        });      

        factory(Client::class,$cantidadClientes)->create();  
        
        $sale = factory(Sale::class,$cantidadVentas)->create()->each(function ($sale) {
            $sale->salesDetails()->save(factory(SaleDetail::class)->make());
        });
    }
}
