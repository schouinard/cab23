<?php

namespace App;

class Benevole extends FilterableModel
{
    protected $appends = ['nom_complet'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'naissance',
        'accepte_ca',
        'inscription',
        'suivi',
        'integration',
    ];

    public function path()
    {
        return '/benevoles/'.$this->id;
    }

    public function getNomCompletAttribute()
    {
        return $this->prenom.' '.$this->nom;
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }

    public function clienteles()
    {
        return $this->belongsToMany(Clientele::class);
    }

    public function interets()
    {
        return $this->belongsToMany(Interet::class);
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class);
    }

    public function addService($service)
    {
        $this->services()->create($service);
    }

    public function addClientele($int)
    {
        $this->clienteles()->sync($int);
    }

    public function addInteret($interet, $attributes = [])
    {
        $this->interets()->sync($interet, $attributes);
    }

    public function addCompetence($competence, $attributes = [])
    {
        $this->competences()->sync($competence, $attributes);
    }

    public function addInteretsCompetences($categoriesInterets)
    {
        foreach ($categoriesInterets as $categoriesInteret) {
            if (key_exists('interets', $categoriesInteret)) {
                $this->addInteret($this->removeUninterested($categoriesInteret['interets']));
            }
            if (key_exists('competences', $categoriesInteret)) {
                $this->addCompetence($this->removeUninterested($categoriesInteret['competences']));
            }
        }
    }

    /**
     * @param $categoriesInteret
     * @return array
     */
    public function removeUninterested($array)
    {
        return array_where($array, function ($value, $key) {
            return $value['priority'] > 0;
        });
    }
}
