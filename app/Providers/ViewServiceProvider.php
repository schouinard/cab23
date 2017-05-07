<?php

namespace App\Providers;

use App\IncomeSource;
use App\Secteur;
use App\ServiceType;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
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

        \View::composer('*', function ($view) {
            $secteurs = \Cache::rememberForever('secteurs', function () {
                return Secteur::orderBy('nom')->get();
            });
            $view->with('secteurs', $secteurs);
        });

        \View::composer(['benevole.index', 'beneficiaire.index'], function ($view) {
            $months = [
                'Janvier' => 1,
                'Février' => 2,
                'Mars' => 3,
                'Avril' => 4,
                'Mai' => 5,
                'Juin' => 6,
                'Juillet' => 7,
                'Août' => 8,
                'Septembre' => 9,
                'Octobre' => 10,
                'Novembre' => 11,
                'Décembre' => 12,
            ];
            $view->with('months', array_flip($months));
        });

        \View::composer(['beneficiaire.show', 'beneficiaire.partials.statut'], function ($view){
            $revenus = \Cache::rememberForever('revenus', function(){
                return IncomeSource::all();
            });
            $view->with('revenus', $revenus);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
