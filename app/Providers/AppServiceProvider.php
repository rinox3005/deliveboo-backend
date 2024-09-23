<?php

namespace App\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Condividi i dati dei ristoranti con tutte le viste che utilizzano il layout principale
        view()->composer('*', function ($view) {

            // Ottieni l'utente loggato
            $user = auth()->user();

            // Recupera il ristorante dell'utente loggato
            $restaurant = $user->restaurant;

            $view->with('restaurant', $restaurant);
        });
    }
}
