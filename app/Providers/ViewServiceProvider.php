<?php

namespace App\Providers;

use App\Autonomie;
use App\BenevoleType;
use App\Category;
use App\Clientele;
use App\Competence;
use App\Day;
use App\EtatSante;
use App\IncomeSource;
use App\Interet;
use App\Mission;
use App\Moment;
use App\OrganismeType;
use App\Regroupement;
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
        \View::composer(['beneficiaire.partials.requests', 'beneficiaire.show'], function ($view) {
            $serviceRequestsStatus = \Cache::rememberForever('serviceRequestsStatus', function () {
                return ServiceRequestStatus::all();
            });
            $view->with('serviceRequestStatuses', $serviceRequestsStatus);
        });

        \View::composer(['beneficiaire.partials.sante'], function ($view) {
            $etats = \Cache::rememberForever('etatsSante', function () {
                return EtatSante::orderBy('nom')->get();
            });
            $autonomies = \Cache::rememberForever('autonomies', function () {
                return Autonomie::orderBy('nom')->get();
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
                'Tous' => '',
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

        \View::composer(['beneficiaire.show', 'beneficiaire.partials.statut', 'beneficiaire.form'], function ($view) {
            $revenus = \Cache::rememberForever('revenus', function () {
                return IncomeSource::all();
            });
            $days = \Cache::rememberForever('days', function () {
                return Day::all();
            });
            $view->with(compact(['revenus', 'days']));
        });

        \View::composer(['tournee.form'], function ($view) {
            $days = \Cache::rememberForever('days', function () {
                return Day::all();
            });
            $view->with(compact(['days']));
        });

        \View::composer(['benevole.form'], function ($view) {
            $types = \Cache::rememberForever('benevoleTypes', function () {
                return BenevoleType::orderBy('nom')->get();
            });
            $view->with('benevoleTypes', $types);
        });

        \View::composer([
            'benevole.partials.interets',
            'service.index',
            'service.edit',
            'benevole.index',
        ], function (
            $view
        ) {
            $interestGroups = \Cache::rememberForever('interestGroups', function () {
                return Category::with('competences')->orderBy('nom')->get();
            });
            $interests = \Cache::rememberForever('interests', function () {
                return Competence::where('type', 'interet')->orderBy('nom')->get();
            });
            $competences = \Cache::rememberForever('competences', function () {
                return Competence::where('type', 'competence')->orderBy('nom')->get();
            });
            $clienteles = \Cache::rememberForever('clienteles', function () {
                return Clientele::orderBy('nom')->get();
            });
            $view->with(compact(['interestGroups', 'interests', 'competences', 'clienteles']));
        });

        \View::composer(['benevole.partials.disponibilites', 'benevole.show', 'benevole.index'], function ($view) {
            $days = \Cache::rememberForever('days', function () {
                return Day::all();
            });
            $moments = \Cache::rememberForever('moments', function () {
                return Moment::all();
            });
            $view->with(['days' => $days, 'moments' => $moments]);
        });

        \View::composer(['organisme.form', 'organisme.show'], function ($view) {
            $type = \Cache::rememberForever('organismeTypes', function () {
                return OrganismeType::orderBy('nom')->get();
            });
            $mission = \Cache::rememberForever('missions', function () {
                return Mission::orderBy('nom')->get();
            });
            $regroupement = \Cache::rememberForever('regroupements', function () {
                return Regroupement::orderBy('nom')->get();
            });
            $view->with(['type' => $type, 'mission' => $mission, 'regroupement' => $regroupement]);
        });

        \View::composer([
            'beneficiaire.show',
            'benevole.show',
            'service.index',
            'service.edit',
            'beneficiaire.partials.requests',
        ],
            function ($view) {
                $serviceTypes = \Cache::rememberForever('serviceTypes', function () {
                    return Competence::where('service_aux_personnes', 1)->orderBy('nom')->get();
                });
                $view->with('serviceTypes', $serviceTypes);
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
