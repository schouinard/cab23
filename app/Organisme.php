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
        'people',
        'regroupements'
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

    public function people()
    {
        return $this->morphMany(Person::class, 'contactable');
    }

    public function adress()
    {
        return $this->belongsTo(Adress::class);
    }

    public function type()
    {
        return $this->belongsTo(OrganismeType::class);
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function regroupements()
    {
        return $this->belongsToMany(Regroupement::class);
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

    public function addPeople($people = [])
    {
        if (! is_null($people)) {
            foreach ($people as $person) {
                $adress = Adress::create($person['adress']);
                $person = new Person(array_except($person, ['adress']));
                $person->adress()->associate($adress);
                $this->people()->save($person);
            }
        }
    }

    public function updatePeople($people)
    {
        foreach ($people as $person) {
            $oldPerson = Person::find($person['id']);
            $oldPerson->adress()->update($person['adress']);
            $oldPerson->update(array_except($person, ['adress']));
        }
    }

    public function addRegroupements($regroupements)
    {
        $this->regroupements()->sync($regroupements);
    }

    public function updateRegroupements($regroupements)
    {
        $this->regroupements()->sync($regroupements);
    }
}
