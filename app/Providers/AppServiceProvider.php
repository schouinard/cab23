<?php

namespace App\Providers;

use App\ServiceType;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer(['beneficiaire.show', 'benevole.show', 'service.index'], function($view){
            $serviceTypes = \Cache::rememberForever('serviceTypes', function(){
                return ServiceType::all()->orderBy('nom');
            });
           $view->with('serviceTypes', $serviceTypes);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
