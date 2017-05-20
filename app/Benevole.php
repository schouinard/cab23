<?php

namespace App;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;

class Benevole extends FilterableModel
{
    use SoftDeletes;

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

    protected $relationsToHandleOnStore = [
        'category',
        'clienteles',
        'adress',
        'disponibilites',
    ];

    public function path()
    {
        return '/benevoles/'.$this->id;
    }

    public function getNaissanceAttribute($value)
    {
        return Carbon::parse($value)->format($this->dateFormat);
    }

    public function getAccepteCaAttribute($value)
    {
        return Carbon::parse($value)->format($this->dateFormat);
    }

    public function getInscriptionAttribute($value)
    {
        return Carbon::parse($value)->format($this->dateFormat);
    }

    public function getIntegrationAttribute($value)
    {
        return Carbon::parse($value)->format($this->dateFormat);
    }

    public function getSuiviAttribute($value)
    {
        return Carbon::parse($value)->format($this->dateFormat);
    }

    public function getNomCompletAttribute()
    {
        return $this->prenom.' '.$this->nom;
    }

    public function getSelectedClientelesAttribute()
    {
        return $this->clienteles->pluck('id')->toArray();
    }

    public function benevoleType()
    {
        return $this->belongsTo(BenevoleType::class);
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

    public function isInterested($id, $priority)
    {
        return count($this->interets->where('id', $id)->where('pivot.priority', $priority));
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class)->withPivot('priority');
    }

    public function isCompetent($id, $priority)
    {
        return count($this->competences->where('id', $id)->where('pivot.priority', $priority));
    }

    public function disponibilites()
    {
        return $this->hasMany(Disponibilite::class);
    }

    public function isDisponible($dayId, $momentId)
    {
        return count($this->disponibilites->where('day_id', $dayId)->where('moment_id', $momentId));
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'notable')->orderBy('date', 'DESC');
    }

    public function addService($service)
    {
        $this->services()->create($service);
    }

    public function addClienteles($int = [])
    {
        $this->clienteles()->sync($int);
    }

    public function updateClienteles($int = [])
    {
        $this->addClienteles($int);
    }

    public function addInteret($interet = [])
    {
        $this->interets()->sync($interet);
    }

    public function addCompetence($competence = [])
    {
        $this->competences()->sync($competence);
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

    public function addCategory($categoriesInterets = [])
    {
        $interets = [];
        $competences = [];
        if (! is_null($categoriesInterets)) {
            foreach ($categoriesInterets as $categoriesInteret) {
                if (key_exists('interets', $categoriesInteret)) {
                    $interets = $interets + $this->removeUninterested($categoriesInteret['interets']);
                }
                if (key_exists('competences', $categoriesInteret)) {
                    $competences = $competences + $this->removeUninterested
                        ($categoriesInteret['competences']);
                }
            }
        }
        $this->addInteret($interets);
        $this->addCompetence($competences);
    }

    public function updateCategory($categoriesInterets)
    {
        $this->addCategory($categoriesInterets);
    }

    /**
     * @param $categoriesInteret
     * @return array
     */
    public function removeUninterested($array)
    {
        $interested = array_where($array, function ($value, $key) {
            return $value['priority'] > 0;
        });

        return $interested;
    }

    public function addDisponibilites($array = [])
    {
        $this->disponibilites()->delete();

        if (count($array) > 0) {
            if ($this->isDisponibilite(array_first($array))) {
                $this->disponibilites()->createMany($array);
            } else {
                $this->createDisponibilitesFromPostData($array);
            }
        }
    }

    public function updateDisponibilites($array = [])
    {
        $this->addDisponibilites($array);
    }

    /**
     * @param $array
     * @return bool
     */
    public function isDisponibilite($array)
    {
        return key_exists('day_id', $array) && key_exists('moment_id', $array);
    }

    /**
     * @param $array
     */
    public function createDisponibilitesFromPostData($array)
    {
        foreach ($array as $dayId => $moments) {
            foreach ($moments as $moment) {
                $this->disponibilites()->create([
                    'day_id' => $dayId,
                    'moment_id' => $moment,
                ]);
            }
        }
    }
}
