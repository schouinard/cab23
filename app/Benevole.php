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

    protected $with = ['adress'];

    protected $relationsToHandleOnStore = [
        'category',
        'clienteles',
        'adress',
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

    public function adress()
    {
        return $this->belongsTo(Adress::class);
    }

    public function clienteles()
    {
        return $this->belongsToMany(Clientele::class);
    }

    public function interets()
    {
        return $this->belongsToMany(Interet::class)->withPivot('priority');
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class)->withPivot('priority');
    }

    public function addService($service)
    {
        $this->services()->create($service);
    }

    public function addClienteles($int)
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

    public function addCategory($categoriesInterets)
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
