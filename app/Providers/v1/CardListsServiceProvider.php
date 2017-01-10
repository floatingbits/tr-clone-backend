<?php

namespace App\Providers\v1;

use App\Services\v1\CardListsService;
use Illuminate\Support\ServiceProvider;

class CardListsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CardListsService::class, function($app) {
            return new CardListsService();
        });
    }
}
