<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisme extends FilterableModel
{
    use SoftDeletes;

    protected $guarded = [];

    protected $relationsToHandleOnStore = [
        'adress',
        'employe',
        'president',
    ];

    public function path()
    {
        return '/organismes/'.$this->id;
    }

    public function getDisplayNomAttribute()
    {
        return $this->nom;
    }

    public function getNomAttribute($value)
    {
        return $this->trashed() ? $value." (INACTIF)" : $value;
    }

    public function president()
    {
        return $this->morphOne(Person::class, 'contactable')->where('lien', 'Président');
    }

    public function employe()
    {
        return $this->morphOne(Person::class, 'contactable')->where('lien', 'Employé');
    }

    public function adress()
    {
        return $this->belongsTo(Adress::class);
    }

    public function type()
    {
        return $this->belongsTo(OrganismeType::class);
    }

    public function secteur()
    {
        return $this->belongsTo(OrganismeSecteur::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'notable')->orderBy('date', 'DESC');
    }

    public function services()
    {
        return $this->morphMany(Service::class, 'serviceable');
    }

    public function addAdress($adress)
    {
        if (is_array($adress)) {
            $adress = Adress::create($adress);
        }
        $this->adress()->associate($adress);
        $this->save();
    }

    public function updateAdress($adress)
    {
        $this->adress()->update($adress);
    }

    public function addPresident($person)
    {
        $adress = Adress::create($person['adress']);
        $this->president()->create([
            'nom' => $person['nom'],
            'lien' => 'Président',
            'adress_id' => $adress->id,
        ]);
    }

    public function updatePresident($person)
    {
        $this->president->adress()->update($person['adress']);
        $this->president()->update([
            'nom' => $person['nom'],
        ]);
    }

    public function addEmploye($person)
    {
        $adress = Adress::create($person['adress']);
        $this->employe()->create([
            'nom' => $person['nom'],
            'lien' => 'Employé',
            'adress_id' => $adress->id,
        ]);
    }

    public function updateEmploye($person)
    {
        $this->employe->adress()->update($person['adress']);
        $this->employe()->update([
            'nom' => $person['nom'],
        ]);
    }
}
