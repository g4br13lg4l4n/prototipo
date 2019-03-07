<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('article','ArticleController',[
    "only" => ["index","show","store","update","destroy"]
]);

Route::resource('category','CategoryController',[
    "only" => ["index","show","store","update","destroy"]
]);

Route::resource('client','ClientController',[
    "only" => ["index","show","store","update","destroy"]
]);
Route::resource('rol','RolController',[
    "only" => ["index","show","store","update","destroy"]
]);

Route::resource('users', 'User\UserController', [
    'except' => ['create', 'edit']
]);

Route::resource('sale', 'SaleController', [
    "only" => ["index","show","store","update","destroy"]
]);

Route::post('users/login', 'User\UserController@login');
Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');