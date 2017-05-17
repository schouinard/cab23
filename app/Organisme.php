<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisme extends FilterableModel
{
    use SoftDeletes;

    protected $guarded = [];

    public function path()
    {
        return '/organismes/' . $this->id;
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

    public function secteur()
    {
        return $this->belongsTo(OrganismeSecteur::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'notable');
    }

    public function addAdress($adress)
    {
        if (is_array($adress)) {
            $adress = Adress::create($adress);
        }
        $this->adress()->associate($adress);
        $this->save();
    }

    public function addPeople($people)
    {
        foreach ($people as $person) {
            $adress = Adress::create($person['adress']);
            $person = new Person(array_except($person, ['adress']));
            $person->adress()->associate($adress);
            $this->people()->save($person);
        }
    }
}
