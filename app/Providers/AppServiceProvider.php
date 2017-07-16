<?php

namespace App\Providers;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ClientRepository::class, function($app) {
            $em = $app->make('em');
            return  $em->getRepository(Client::class);
        });
    }
}
