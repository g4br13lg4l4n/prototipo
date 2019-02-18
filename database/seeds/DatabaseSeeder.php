<?php

use App\User;
use App\Article;
use App\Category;
use App\ArticleCategory;
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
        $categoryController = new CategoryController();

        factory(User::class, $cantidadUsuarios)->create();
        factory(App\User::class)->create(
            [
                'name' => 'Administrador', 
                'email' => 'admin@dopsa.com', 
                'status' => 'Activo',
                'password' => bcrypt('secret'),
            ]
        );
        for ($i = 1; $i <= $cantidadCategorias; $i++) {
           $category = factory(App\Category::class)->create();
           factory(App\Category::class)->create(
                [
                    'genericCode' => $categoryController->generationCode($category->genericCode), 
                    'category' => "Categoria_".$i,
                    'shortName' =>"Cat_".$i,
                    'description' => str_random(30),
                    'level' => 1
                ]
           );
        }  
        
        factory(App\Article::class,$cantidadArticulos)->create()->each(function($article){
            $article->categories()->attach([
                 rand(1,10)
            ]);
        });        
        
    }
}
