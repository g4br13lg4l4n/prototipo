<?php

use App\User;
use App\Article;
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
        $catidadArticulos = 200;
        factory(User::class, $cantidadUsuarios)->create();
        factory(Article::class, $catidadArticulos)->create();
    }
}
