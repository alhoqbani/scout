<?php

namespace App\Providers;

use App\Support\MySqlSearchEngine;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Post::observe(PostObserver::class);
        
        resolve(EngineManager::class)->extend('mysql', function () {
            return new MySqlSearchEngine;
        });
        
    }
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function () {
            return ClientBuilder::create()->build();
        });
    }
}
