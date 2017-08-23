<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    protected $guarded = [];

    protected $with = ['secteur'];

    protected $attributes = [
        'ville' => 'Québec',
        'province' => 'QC',
    ];

    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }

    public function toHTML()
    {
        $secteur = isset($this->secteur) ? $this->secteur->nom .', ': "";
        return $this->adresse."<br />".$secteur.$this->ville . "<br />" . $this->code_postal;
    }
}
