<?php

namespace App\Providers;

use App\Autonomie;
use App\BenevoleType;
use App\CategorieInteretCompetence;
use App\Clientele;
use App\EtatSante;
use App\IncomeSource;
use App\Secteur;
use App\ServiceRequestStatus;
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
        \View::composer(['beneficiaire.show', 'benevole.show', 'service.index', 'beneficiaire.partials.requests'],
            function ($view) {
                $serviceTypes = \Cache::rememberForever('serviceTypes', function () {
                    return ServiceType::orderBy('nom')->get();
                });
                $view->with('serviceTypes', $serviceTypes);
            });

        \View::composer(['beneficiaire.partials.requests', 'beneficiaire.show'], function ($view) {
            $serviceRequestsStatus = \Cache::rememberForever('serviceRequestsStatus', function() {
                return ServiceRequestStatus::all();
            });
            $view->with('serviceRequestStatuses', $serviceRequestsStatus);
        });

        \View::composer(['beneficiaire.partials.sante'], function ($view) {
            $etats = \Cache::rememberForever('etatsSante', function() {
                return EtatSante::all();
            });
            $autonomies = \Cache::rememberForever('autonomies', function(){
                return Autonomie::all();
            });
            $view->with('etatsSante', $etats)->with('autonomies', $autonomies);
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

        \View::composer(['beneficiaire.show', 'beneficiaire.partials.statut'], function ($view) {
            $revenus = \Cache::rememberForever('revenus', function () {
                return IncomeSource::all();
            });
            $view->with('revenus', $revenus);
        });

        \View::composer(['benevole.create'], function ($view) {
            $types = \Cache::rememberForever('benevoleTypes', function () {
                return BenevoleType::all();
            });
            $view->with('benevoleTypes', $types);
        });

        \View::composer(['benevole.partials.interets'], function ($view) {
            $interestGroups = \Cache::rememberForever('interestGroups', function () {
                return CategorieInteretCompetence::all();
            });
            $clienteles = \Cache::rememberForever('clienteles', function(){
                return Clientele::all();
            });
            $view->with(['interestGroups' => $interestGroups, 'clienteles' => $clienteles]);
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
