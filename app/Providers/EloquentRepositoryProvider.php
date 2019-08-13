<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EloquentRepositoryProvider extends ServiceProvider
{
    protected $defer = true;
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Contracts\Repositories\BookRepositoryInterface::class, 
            \App\Repositories\Eloquent\BookRepository::class
        ); 

        $this->app->singleton(
            \App\Contracts\Repositories\ReviewRepositoryInterface::class, 
            \App\Repositories\Eloquent\ReviewRepository::class
        ); 
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
