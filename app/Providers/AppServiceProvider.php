<?php

namespace App\Providers;

use App\Quartier;
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
        \View::composer(['beneficiaire.show', 'benevole.show', 'service.index'], function ($view) {
            $serviceTypes = \Cache::rememberForever('serviceTypes', function () {
                return ServiceType::orderBy('nom')->get();
            });
            $view->with('serviceTypes', $serviceTypes);
        });

        \View::composer(['beneficiaire.create', 'benevole.create'], function ($view) {
           $quartiers = \Cache::rememberForever('quartiers', function(){
               return Quartier::orderBy('nom')->get();
           });
           $view->with('quartiers', $quartiers);
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
