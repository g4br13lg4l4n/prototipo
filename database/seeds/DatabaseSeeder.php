<?php

use App\Sale;
use App\User;
use App\Client;
use App\Article;
use App\Category;
use App\SaleDetail;
use Illuminate\Support\Facades\DB;
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

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Article::truncate();
        SaleDetail::truncate();
        Sale::truncate();

        DB::table('article_category')->truncate();

        User::flushEventListeners();
        Category::flushEventListeners();
        Article::flushEventListeners();
        Sale::flushEventListeners();
        SaleDetail::flushEventListeners();

        $cantidadUsuarios = 10;
        $cantidadClientes = 20;
        $cantidadArticulos = 50;
        $cantidadCategorias = 20;
        $cantidadVentas = 20;
        $cantidadVentasDetalles = 3;
        
        factory(User::class, $cantidadUsuarios)->create();
        factory(Client::class, $cantidadClientes)->create();
        factory(Category::class, $cantidadCategorias)->create();
        factory(Article::class, $cantidadArticulos)->create()->each(
			function ($articulo) {
                $categorias = Category::all()->random(mt_rand(1, 5))->pluck('id');
                $articulo->categories()->attach($categorias);
			}
        ); 

        factory(Sale::class, $cantidadVentas)->create()->each(
            function($sale ){
                $sale->salesDetails()->save(factory(SaleDetail::class)->make());
            }
        );
        
    }
}
