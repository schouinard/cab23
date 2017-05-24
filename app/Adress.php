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
        return $this->adresse."<br />".$this->ville.', '.$this->secteur->nom . "<br />" . $this->code_postal;
    }
}
