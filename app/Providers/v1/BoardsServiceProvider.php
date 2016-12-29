<?php

namespace App\Providers\v1;

use App\Services\v1\BoardsService;
use Illuminate\Support\ServiceProvider;

class BoardsServiceProvider extends ServiceProvider
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
        $this->app->bind(BoardsService::class, function($app) {
            return new BoardsService();
        });
    }
}
