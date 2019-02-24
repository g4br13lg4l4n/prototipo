<?php

namespace App\Providers;

use App\Client;
use Carbon\Carbon;
use App\Policies\ClientPolicy;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Client::class => ClientPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Route::group(['middleware' => 'oauth.providers'], function () {
            Passport::routes(function ($router) {
                return $router->forAccessTokens();
            });
        });

        Passport::tokensExpireIn(Carbon::now()->addMinutes(30));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        //Passport::enableImplicitGrant();

        Passport::tokensCan([
            'purchase-article' => 'Crear transacciones para comprar productos',
            'manage-products' => 'Crear, ver, actualizar y eliminar productos',
            'manage-account' => 'Obtener información de la cuenta, nombre, email, estado (Sin contraseña), modificar datos como email, nombre y contraseña. No puede eliminar la cuenta',
            'read-general' => 'Obtener la información en general, categorías en la que se compra y se vende, productos vendidos o comprados, transacciones, compras y ventas',
            'shop' => 'Obtener lista de productos, y artículos'
        ]);
    }
}
